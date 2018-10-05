<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer([
            'admins.index',
            'admins.addgrades',
            'admins.addinstructor',
            'admins.pre-enrol',
            'admins.schedule',
            'instructors.index',
            'instructors.schedule',
            'parents.index',
            'parents.viewgrade',
            'students.index',
            'students.evaluate',
            'students.preenrol',
            'students.schedule',
        ] , function ($view) {
            $view->with('user_info',User::where('id',Auth::user()->id)->first());
        });
    }
}
