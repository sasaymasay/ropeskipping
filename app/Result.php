<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'group_id', 'discipline_id', 'competition_id', 'user_id', 'score_id','rank_id', 'gender_id', 'age_id', 'team_members', 'final_score', 'score', 'judge_id'
    ];
    public function competition() {
       return $this->belongsTo('App\Competition');
   }
    public function group() {
       return $this->belongsTo('App\Group');
   }
    public function discipline() {
       return $this->belongsTo('App\Discipline');
   }
    public function score() {
       return $this->belongsTo('App\Score');
   }
    public function age() {
       return $this->belongsTo('App\Age');
   }
    public function gender() {
       return $this->belongsTo('App\Gender');
   }
    public function user() {
       return $this->belongsTo('App\User');
   }
    public function rank() {
       return $this->belongsTo('App\Rank');
   }
}
