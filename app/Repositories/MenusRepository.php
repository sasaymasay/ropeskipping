<?php

namespace App\Repositories;

use App\Menu;

class MenusRepository extends Repository {
    
    public function __constuct(Menu $menu){
        $this->mmodel=$menu;
        
    }
    
}

