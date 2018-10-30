<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'title', 'otganizator', 'info', 'adress', 'place', 'city', 'alias', 'status',
    ];
    
    public function users() {
       return $this->belongsToMany('App\User');//,'competition_user','user_id', 'competition_id');
   
   }
    public function judges() {
       return $this->belongsToMany('App\Judge');//,'competition_judge','competition_id','judge_id');
   
   }
    public function disciplines() {
       return $this->belongsToMany('App\Discipline');
   
   }
    public function groups() {
       return $this->belongsToMany('App\Group');
   
   }
    public function results() {
       return $this->hasMany('App\Result');
   }
}
