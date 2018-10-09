<?php

namespace App\Providers;

use App\Instructor;
use App\Room;
use App\Subject;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'admins.scheduling',
            'admins.list-instructors',
            'admins.send',
            'admins.listrooms',
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

         view()->composer(['admins.scheduling','admins.schedule'] , function ($view) {
            $view->with('rooms',Room::all());
            $view->with('instructors',Instructor::all());
            $view->with('first_sem_first_year_subjects',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 1 AND semester = 1")
                )
            );
            $view->with('first_sem_first_year_subjects',
             DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 1 AND semester = 1")
                )
            );
            $view->with('second_sem_first_year_subjects',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 1 AND semester = 2")
                )
            );
            $view->with('first_sem_second_year_subjects',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 2 AND semester = 1")
                )
            );
            $view->with('second_sem_second_year_subjects',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 2 AND semester = 2")
                )
            );

            $view->with('first_sem_third_year_subjects',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 3 AND semester = 1")
                )
            );
            $view->with('second_sem_third_year_subjects',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 3 AND semester = 2")
                )
            );

            $view->with('third_year_summer',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 3 AND semester = ''")
                )
            );

            $view->with('first_sem_fourth_year_subjects',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 4 AND semester = 1")
                )
            );
            $view->with('second_sem_fourth_year_subjects',
            DB::select(
                    DB::raw("SELECT * FROM subjects WHERE year = 4 AND semester = 2")
                )
            );
         });
    }
}
