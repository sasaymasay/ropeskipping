<?php

namespace App\Repositories;

use App\Portfolio;

class PortfoliosRepository extends Repository {
    
    public function __constuct(Portfolio $portfolio){
        $this->pmodel=$portfolio;
    }
    
    
}