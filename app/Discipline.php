<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
     protected $fillable = [
        'name', 'discription', 'group_id', 'ident',
    ];
    
     public function competitions() {
       return $this->belongsToMany('App\Competition');//,'competition_judge','competition_id','judge_id');
   }
    public function results() {
       return $this->hasMany('App\Result');
   }
   
    public function group() {
       return $this->belongsTo('App\Group');
   }
}
