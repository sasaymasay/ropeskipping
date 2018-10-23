<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
     protected $fillable = [
        'name', 'ident',
    ];
    
     public function competitions() {
       return $this->belongsToMany('App\Competition');//,'competition_judge','competition_id','judge_id');
   }
     public function results() {
       return $this->hasMany('App\Result');
   }
   
     public function disciplines() {
       return $this->hasMany('App\Discipline');
   }
}
