<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
      public function users() {
       return $this->hasMany('App\User');
   }
      public function uresults() {
       return $this->hasMany('App\Result');
   }
    public function judge() {
       return $this->belongsTo('App\Judge');
   }
}
