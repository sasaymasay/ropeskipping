<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //
        $router->pattern('alias','[\w-]+');
       
        parent::boot($router);
        
        $router->model('competition', 'App\Competition');
        
        $router->bind('articless', function ($value) {
        	return \App\Article::where('alias',$value)->first();
        });
        
        
        $router->bind('users', function ($value) {
        	return \App\User::find($value);
        });
        
        $router->bind('judges', function ($value) {
        	return \App\Judge::find($value);
        });
        
        $router->bind('disc', function ($value) {
        	return \App\Discipline::find($value);
        });
        
        $router->bind('groups', function ($value) {
        	return \App\Group::find($value);
        });
        
        $router->bind('comps', function ($value) {
        	return \App\Competition::find($value);
        });
        
        $router->bind('signup', function ($value) {
        	return \App\Result::find($value);
        });
        
        $router->bind('scores', function ($value) {
        	return \App\Result::find($value);
        });
        
       
        
       
        
      
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->mapWebRoutes($router);

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
