<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Course;

class CourseComposer
{
    private $course;
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('courses',$this->course->get());
    }
}

?>