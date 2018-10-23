<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'score_j1', 'score_j2', 'user_id', 'judge_id1', 'judge_id2', 'discipline_id', 'competition_id', 'major_judge',
    ];
    
     public function results() {
       return $this->hasMany('App\Result');
   }
   public function judge() {
       return $this->belongsTo('App\Judge');
   }
   public function user() {
       return $this->belongsTo('App\User');
   }
   
   public function competition() {
       return $this->belongsTo('App\Competition');
   }
   
   public function group() {
       return $this->belongsTo('App\Group');
   }
}
