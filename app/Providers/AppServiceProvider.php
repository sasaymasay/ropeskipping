<?php

namespace App\Providers;

use Blade;

use DB;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('set',function($exp) {
        	
        	list($name,$val) = explode(',',$exp);
        	
        	return "<?php $name = $val ?>";
        	
        });
        
      
        //view()->share('final_score', \App\Score::where(['user_id'=>$use, 'discipline_id'=>$disc])->avg('score'));
        
        /**DB::listen(function($query) {
            dump($query->sql);
        	
        	//echo '<h1>'.$query->sql.'</h1>';
        	
        });**/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
