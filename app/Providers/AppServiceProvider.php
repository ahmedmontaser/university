<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive("admin", function () {
        	return "<?php if ( auth()->user()->type == 3 ) { ?>";
		});

        Blade::directive("endadmin", function () {
        	return "<?php } ?>";
		});

		Blade::directive("professor", function () {
			return "<?php if ( auth()->user()->type == 2 ) { ?>";
		});

		Blade::directive("endprofessor", function () {
			return "<?php } ?>";
		});

		Blade::directive("notStudent", function () {
			return "<?php if( auth()->user()->type == 2 || auth()->user()->type == 3 ) { ?>";
		});

		Blade::directive("endNotStudent", function () {
			return "<?php } ?>";
		});

		Blade::directive("student", function () {
			return "<?php if ( auth()->user()->type == 1 ) { ?>";
		});

		Blade::directive("endstudent", function () {
			return "<?php } ?>";
		});




    }
}
