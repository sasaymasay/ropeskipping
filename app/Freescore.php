<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freescore extends Model
{
    protected $fillable = [
         'user_id', 'judge_idsp1', 'judge_idsp2', 'judge_idsp3','judge_idtz1', 'judge_idtz2', 'judge_idtz3', 'sloz1', 'plot1', 'sloz2', 'plot2', 'sloz3', 'plot3', 'tech1',  'zrel1', 'tech2',  'zrel2', 'tech3',  'zrel3', 'discipline_id','competition_id', 'group_id',
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
}