<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;

class JudgePolicy


{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
     public function create(User $user){
        return $user->canDo('EDIT_JUDGES');
    }
    
    public function edit(User $user){
        return $user->canDo('EDIT_JUDGES');
    }
    
   
}
