<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
     public function users() {
       return $this->hasMany('App\User');//,'team_user','team_id','user_id');
}
}
