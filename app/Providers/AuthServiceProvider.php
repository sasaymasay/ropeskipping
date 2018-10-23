<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Article;

use App\Permission;

use App\User;

use App\Judge;

use App\Discipline;

use App\Group;

use App\Competition;

use App\Policies\ArticlePolicy;

use App\Policies\PermissionPolicy;

use App\Policies\JudgePolicy;

use App\Policies\UserPolicy;

use App\Policies\DisciplinePolicy;

use App\Policies\GroupPolicy;

use App\Policies\CompetitionsPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Permission::class =>PermissionPolicy::class,
        User::class =>UserPolicy::class,
        Judge::class =>JudgePolicy::class,
        Discipline::class =>DisciplinePolicy::class,
        Group::class =>GroupPolicy::class,
        Competition::class =>CompetitionsPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
    
        $this->registerPolicies($gate);
        
        $gate->define('VIEW_ADMIN', function($user){
            return $user->canDo('VIEW_ADMIN', FALSE);
        });
        
        $gate->define('VIEW_ADMIN_ARTICLES', function($user){
            return $user->canDo('VIEW_ADMIN_ARTICLES', FALSE);
        });
        
        $gate->define('EDIT_USERS', function($user){
            return $user->canDo('EDIT_USERS', FALSE);
        });
        
        $gate->define('EDIT_PERMISSIONS', function($user){
            return $user->canDo('EDIT_PERMISSIONS', FALSE);
        });
        
        $gate->define('EDIT_JUDGES', function($user){
            return $user->canDo('EDIT_JUDGES', FALSE);
        });
        
        $gate->define('EDIT_DISCIPLINES', function($user){
            return $user->canDo('EDIT_DISCIPLINES', FALSE);
        });
        
        $gate->define('EDIT_GROUPS', function($user){
            return $user->canDo('EDIT_GROUPS', FALSE);
        });
        
        $gate->define('EDIT_COMPETITIONS', function($user){
            return $user->canDo('EDIT_COMPETITIONS', FALSE);
        });

        //
    }
}
