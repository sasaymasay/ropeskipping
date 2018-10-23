<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
     protected $fillable = [
        'name', 'email', 'password', 'surname', 'patronymic', 'rank', 'city',
    ];
    
 public function competitions() {
       return $this->belongsToMany('App\Competition');//,'competition_judge','competition_id','judge_id');
   }
   
 public function scores() {
       return $this->hasMany('App\Score');//,'competition_judge','competition_id','judge_id');
   }
   public function users() {
       return $this->belongsToMany('App\User','judge_user');
   }
 
}
