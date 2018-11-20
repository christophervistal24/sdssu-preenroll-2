<?php

namespace App\Providers;

use App\Admin;
use App\AssistantDean;
use App\Block;
use App\Course;
use App\Instructor;
use App\Room;
use App\Semester;
use App\Student;
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
         view()->composer(['admins.index'] , function ($view) {
            $view->with('semesters',Semester::all());
        });



        view()->composer([
            'admins.index',
            'admins.addgrades',
            'admins.addinstructor',
            'admins.pre-enrol',
            'admins.schedule',
            'admins.scheduling',
            'admins.list-instructors',
            'admins.list-of-students',
            'admins.send',
            'admins.listrooms',
            'admins.subjects',
            'admins.addstudent',
            'admins.studentaddsubject',
            'admins.view-preenrollrequest',
            'admins.listblocks',
            'instructors.index',
            'instructors.schedule',
            'instructors.students',
            'parents.index',
            'parents.viewgrade',
            'students.index',
            'students.evaluate',
            'students.preenrol',
            'students.schedule',
            'students.preenrolldetails',
            'deans.assistant.index',
            'deans.assistant.listschedule',
            'deans.assistant.instructors',
        ] , function ($view) {
    foreach (User::where('id',Auth::user()->id)->first()->roles as $role) {
        switch ($role->name) {
            case 'Instructor':
                $view->with('user_info',Instructor::where('id_number',Auth::user()->id_number)->first());
                break;

            case 'Assistant Dean':
                $view->with('user_info',AssistantDean::where('id_number',Auth::user()->id_number)->first());
                break;

            case 'Student':
                $view->with('user_info',Instructor::where('id',Auth::user()->id)->first());
                break;

            case 'Admin':
                $view->with('user_info',Admin::where('id_number',Auth::user()->id_number)->first());
                break;

        }
    }
        });

         view()->composer(['admins.subjects'] , function ($view) {
            $view->with('courses',Course::all());
         });

         view()->composer(['admins.scheduling','admins.schedule','admins.studentaddsubject'] , function ($view) {
            $view->with('rooms',Room::all());
            $view->with('instructors',Instructor::all());
            $view->with('blocks',Block::where('status','open')->orderBy('level', 'ASC')->get());
            $view->with('first_year_subjects',Subject::where('year',1)->get());
            $view->with('second_year_subjects',Subject::where('year',2)->get());
            $view->with('third_year_subjects',Subject::where('year',3)->get());
            $view->with('fourth_year_subjects',Subject::where('year',4)->get());
         });
    }
}
