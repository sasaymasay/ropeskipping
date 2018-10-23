<?php

namespace App\Repositories;

use App\Slider;

class SlidersRepository extends Repository {
    
    public function __constuct(Slider $slider){
        $this->smodel=$slider;
        
    }
    
}

