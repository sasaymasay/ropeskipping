<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname', 'patronymic', 'country', 'city', 'gender', 'birthday', 'rank_id', 'gender_id', 'age_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
     public function age() {
       return $this->belongsTo('App\Age');
    }
    
    public function scores() {
       return $this->hasMany('App\Score');//,'competition_judge','competition_id','judge_id');
   }
    
     public function rank() {
       return $this->belongsTo('App\Rank');
   }
   public function gender()
    {
        return $this->belongsTo('App\Gender');
    }
   
   public function team() {
       return $this->belongsTo('App\Team');//,'team_user','team_id','user_id');
   }
   
    public function competitions() {
       return $this->belongsToMany('App\Competition');//,'competition_user','user_id', 'competition_id');
   }
   
    public function results() {
       return $this->hasMany('App\Result');
   }
    public function articles() {
       return $this->hasMany('App\Article');
   }
    public function roles() {
       return $this->belongsToMany('App\Role','role_user');
   }
    public function judges() {
       return $this->belongsToMany('App\Judge','judge_user');
   }
    public function canDO($permission,$require = FALSE) {
        if(is_array($permission)){
            foreach ($permission as $permName){
                $permName = $this->canDo($permName);
                if ($permName && !$require){
                    return TRUE;
                }
                elseif(!$permName && $require){
                    return FALSE;
                }
            }
            return $require;
        }
        else {
            foreach ($this->roles as $role){
                foreach ($role->perms as $perm) {
                    if(str_is($permission, $perm->name)){
                        return TRUE;
                    }
                }
            }
            
            
        }
       
        
   }
   
   public function hasRole($name, $require = FALSE){
       
    if(is_array($name)){
            foreach ($name as $roleName){
                $hasRole = $this->hasRole($roleName);
                if ($hasRole && !$require){
                    return TRUE;
                }
                elseif(!$hasRole && $require){
                    return FALSE;
                }
            }
            return $require;
        }
        else {
            foreach ($this->roles as $role){
                if ($role->name == $name) {
                    
                        return TRUE;
                    
                }
            }
            
            
        }
       
        
   }
}
