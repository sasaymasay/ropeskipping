<?php

namespace App\Repositories;

use App\Group;

use Gate;


class AdminGroupsRepository extends Repository {

    public function __constuct(Group $group) {
        $this->grmodel = $group;
    }
    
     public function addGroup($request){
        if (Gate::denies('create', new Group)){
            abort(403);
        }
        $data = $request->all();

        
        $group = Group::create([
            'name'=>$data['name'],

        ]);
        
        
       
        
        
        return ['status'=>'Дисциплина добавлена'];
    }
    
    public function updateGroup($request, $group){
        if(Gate::denies('edit', new Group)){
            abort(403);
        }
        $data = $request->all();
        
        $group->fill($data)->update();
        
        return ['status'=>'Дисциплина изменена'];
    }
    
    public function deleteGroup($group){
    if (Gate::denies('edit', new Group)){
            abort(403);
        }

        
        if($group->delete()){
            return ['status'=>'Дисциплина удалена'];
        }
    }
}
