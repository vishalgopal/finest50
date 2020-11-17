<?php

namespace App\Providers;
use Auth;
use View;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use App\Location;
use App\Category;
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
        $locations = Location::all();
        // $userlocation = \Location::get(\Request::ip());
        View::share('locations',$locations);
        $categories = Category::where('parent',0)->with('children')->get();
        View::share('categories',$categories);
        // View::share('users',$users);
        // Schema::defaultStringLength(191);   
    }
}
