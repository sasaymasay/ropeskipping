<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','img','alias','text','disc',];
    
    
    public function user() {
       return $this->belongsTo('App\User');
   }
}
