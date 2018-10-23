<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    public function user() {
       return $this->hasOne('App\User');
   }
    public function results() {
       return $this->hasMany('App\Result');
   }
}
