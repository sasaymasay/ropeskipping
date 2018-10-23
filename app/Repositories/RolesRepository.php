<?php

namespace App\Repositories;

use App\Role;

class RolesRepository extends Repository {
    
    public function __constuct(Role $role){
        $this->rmodel=$role;
        
    }
    
}
