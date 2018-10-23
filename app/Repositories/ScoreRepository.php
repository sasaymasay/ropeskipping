<?php

namespace App\Repositories;

use App\Score;
use App\Freescore;






class ScoreRepository extends Repository {

    public function __constuct(Score $score) {
        $this->scmodel = $score;
    }
    
     public function addScore($request, $score){
         
         $data = $request->all();
         
         $score = Score::create([
            
            
                    'user_id' => $data['user_id'],
                    'judge_id1' => $data['judge_id1'],
                    'score_j1' => $data['score_j1'],
                    'judge_id2' => $data['judge_id2'],
                    'score_j2' => $data['score_j2'],
                    'major_judge' => $data['major_judge'],
                    'discipline_id' => $data['discipline_id'],
                    'competition_id' => $data['competition_id'],
        ]);
         return ['status' => 'Оценки выставлены'];
        }


   
     
     public function updateScore($request, $freescore){
       
       
         
        $data = $request->all();

        $freescore = Freescore::create([
            
           
            'judge_idsp1'=>$data['judge_idsp1'],
            'sloz1' => $data['sloz1'],
            'plot1' => $data['plot1'],
            'judge_idsp2'=>$data['judge_idsp2'],
            'sloz2' => $data['sloz2'],
            'plot2' => $data['plot2'],
            'judge_idsp3'=>$data['judge_idsp3'],
            'sloz3' => $data['sloz3'],
            'plot3' => $data['plot3'],
            'judge_idtz1'=>$data['judge_idtz1'],
            'tech1' => $data['tech1'],
            'zrel1' => $data['zrel1'],
            'judge_idtz2'=>$data['judge_idtz2'],
            'tech2' => $data['tech2'],
            'zrel2' => $data['zrel2'],
            'judge_idtz3'=>$data['judge_idtz3'],
            'tech3' => $data['tech3'],
            'zrel3' => $data['zrel3'],
            'user_id' =>$data['user_id'] ,
            'discipline_id'=>$data['discipline_id'],
             
                                ]);

        return ['status' => 'Оценки выставлены'];
    }
    
     
   
    public function deleteResult($result){

        
        if($result->delete()){
            
            return ['status' => 'Результат удален'];
        }
    
}
}



