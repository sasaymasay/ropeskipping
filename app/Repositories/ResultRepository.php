<?php

namespace App\Repositories;

use App\Result;



use Auth;




class ResultRepository extends Repository {

    public function __constuct(Result $result) {
        $this->remodel = $result;
    }
    
     public function addResult($request){


       $data = $request->all();
       

       $result = Result::create([
            'user_id' => Auth::user()->id,
            'competition_id'=>$data['competition_id'],
            'group_id'=>$data['group_id'],
            'discipline_id'=>$data['discipline_id'],
            'gender_id'=>$data['gender_id'],
            'age_id'=>$data['age_id'],
            'rank_id'=>$data['rank_id'],
            'team_members'=>$data['team_members'],
            
           
           ]);
       

                  
       return ['status' => 'Регистрация прошла успешна'];
      

       //if ($request->user()->results()->save($this->remodel)) {
        }
         
    //}

   
     
     public function updateResult($request, $result){
       
        $data = $request->all();
        
        $result->fill($data)->update();
       
        
        return ['status'=>'Резудьтат изменена'];
    }
    
     
   
    public function deleteResult($result){

        
        if($result->delete()){
            
            return ['status' => 'Результат удален'];
        }
    
}
}


