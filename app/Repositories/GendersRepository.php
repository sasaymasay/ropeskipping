<?php

namespace App\Repositories;

use App\Gender;

class GendersRepository extends Repository {
    
    public function __constuct(Gender $gender){
        $this->gmodel=$gender;
        
    }
    
}
