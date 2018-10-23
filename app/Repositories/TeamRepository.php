<?php

namespace App\Repositories;

use App\Team;




class TeamRepository extends Repository {

    public function __constuct(Team $team) {
        $this->tmodel = $team;
    }
}