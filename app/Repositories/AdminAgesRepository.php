<?php

namespace App\Repositories;

use App\Age;

class AdminAgesRepository extends Repository {

    public function __constuct(Age $age) {
        $this->agmodel = $age;
    }
}
