<?php

namespace App\Providers;

use App\Http\View\Composers\{
AdminComposer , AssistantDeanComposer , CourseComposer ,
InstructorComposer , ParentComposer , StudentComposer ,
ScheduleComposer
};
use App\{Semester , Subject};
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admins.subjects',CourseComposer::class);
        View::composer('admins.*',AdminComposer::class);
        View::composer('students.*',StudentComposer::class);
        View::composer('instructors.*',InstructorComposer::class);
        View::composer('deans.assistant.*',AssistantDeanComposer::class);
        View::composer('parents.*',ParentComposer::class);
        View::composer(['templates-dashboard.modal-edit-schedule','admins.scheduling'],ScheduleComposer::class);
        View::composer('admins.index' , function ($view) {
            $view->with('semesters',Semester::all());
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
