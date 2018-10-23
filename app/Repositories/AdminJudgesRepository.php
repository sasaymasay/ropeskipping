<?php

namespace App\Repositories;

use App\Judge;

use Gate;


class AdminJudgesRepository extends Repository {

    public function __constuct(Judge $judge) {
        $this->jmodel = $judge;
    }
    public function addJudge($request){
        if (Gate::denies('create', new Judge)){
            abort(403);
        }
        $data = $request->all();
        
        $judge = Judge::create([
            'name'=>$data['name'],
            'surname'=>$data['surname'],
            'patronymic'=>$data['patronymic'],
            'city'=>$data['city'],
            'rank'=>$data['rank'],
            
            
        ]);
        
       
        return ['status'=>'Судья добавлен'];
    }
    
    public function updateJudge($request, $judge){
        if(Gate::denies('edit', new Judge)){
            abort(403);
        }
        $data = $request->all();
        
         if(isset($data['name'])){
            
        }
        
        
        $judge->fill($data)->update();
        
        
        return ['status'=>'Судья изменен'];
    }
    
    public function deleteJudge($judge){
    if (Gate::denies('edit', $judge)){
            abort(403);
        }
        
        
        if($judge->delete()){
            return ['status'=>'Судья удален'];
        }
    }
}