<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     public function users() {
       return $this->belongsToMany('App\User','role_user');
   }
   
   public function perms() {
       return $this->belongsToMany('App\Permission','permission_role');
   }
   
    public function hasPermission($name,$require = FALSE) {
        
        if(is_array($name)){
            foreach ($name as $permName){
                $hasPermission = $this->hasPermission($permName);
                
                if ($hasPermission && !$require){
                    return TRUE;
                }
                elseif(!$hasPermission && $require){
                    return FALSE;
                }
            }
            return $require;
        }
        else {
            foreach ($this->perms as $permission){
                    if($permission->name == $name){
                        return TRUE;
                    }
                
            }
            
            
        }
       
        
   }
   
   public function savePermissions($inputPermissions){
       if(!empty($inputPermissions)){
           $this->perms()->sync($inputPermissions);
       }
       else{
           $this->perms()->detach();
       }
       
       return TRUE;
       
   }
   
}
