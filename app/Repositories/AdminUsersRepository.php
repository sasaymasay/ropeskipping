<?php

namespace App\Repositories;

use App\User;

use Gate;


class AdminUsersRepository extends Repository {

    public function __constuct(User $user) {
        $this->umodel = $user;
    }
    
    public function addUser($request){
        if (Gate::denies('create', new User)){
            abort(403);
        }
        $data = $request->all();
        
        $user = User::create([
            'name'=>$data['name'],
            'surname'=>$data['surname'],
            'patronymic'=>$data['patronymic'],
            'city'=>$data['city'],
            'gender'=>$data['gender'],
            'country'=>$data['country'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'rank_id'=>$data['rank_id'],
            'gender_id'=>$data['gender_id'],
        ]);
        
        
        if($user){
            $user->roles()->attach($data['role_id']);
        }
        return ['status'=>'Пользователь добавлен'];
    }
    
    public function updateUser($request, $user){
        if(Gate::denies('edit', new User)){
            abort(403);
        }
        $data = $request->all();
        
        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        $user->fill($data)->update();
        $user->roles()->sync([$data['role_id']]);
        
        return ['status'=>'Пользователь изменен'];
    }
    
    public function deleteUser($user){
    if (Gate::denies('edit', new User)){
            abort(403);
        }
        
        $user->roles()->detach();
        
        if($user->delete()){
            return ['status'=>'Пользователь удален'];
        }
    }
}
