<?php
namespace App\Http\View\Composers;

use App\{Block , Instructor, Room , Subject};
use Illuminate\View\View;

class ScheduleComposer
{


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('rooms',Room::all());
        $view->with('blocks',Block::orderBy('level', 'ASC')->Open()->get());
        $view->with('instructors',Instructor::all());
        if (str_contains(url()->current() , '/admin/schedule')) {
            $groupBy = ['year'];
        } else if (str_contains(url()->current(), '/admin/scheduling')) {
            $groupBy = ['year','course'];
        }
        $view->with('subjects',Subject::get()->groupBy($groupBy));

    }
}

?>