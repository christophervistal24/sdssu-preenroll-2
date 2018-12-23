<?php
namespace App\Http\View\Composers;

use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StudentComposer
{

    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //get the user information
        if (str_contains(url()->current(),'/student/')) {
            $view->with('user_info',
                $this->student->where('id_number',Auth::user()->id_number)->first()
            );
        }

    }
}

?>