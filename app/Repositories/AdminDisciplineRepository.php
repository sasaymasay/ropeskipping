<?php

namespace App\Repositories;

use App\Discipline;

use Gate;


class AdminDisciplineRepository extends Repository {

    public function __constuct(Discipline $discipline) {
        $this->dmodel = $discipline;
    }
    
     public function addDiscipline($request){
        if (Gate::denies('create', new Discipline)){
            abort(403);
        }
        $data = $request->all();
        
        $discipline = Discipline::create([
            'name'=>$data['name'],
            'discription'=>$data['discription'],
            'group_id'=>$data['group_id'],
            'ident'=>$data['group_id'],
            
        ]);
        
        
        
        return ['status'=>'Дисциплина добавлена'];
    }
    
    public function updateDiscipline($request, $discipline){
        if(Gate::denies('edit', new Discipline)){
            abort(403);
        }
        $data = $request->all();
        
        $discipline->fill($data)->update();
        
        return ['status'=>'Дисциплина изменена'];
    }
    
    public function deleteDiscipline($discipline){
    if (Gate::denies('edit', new Discipline)){
            abort(403);
        }

        
        if($discipline->delete()){
            return ['status'=>'Дисциплина удалена'];
        }
    }
}
