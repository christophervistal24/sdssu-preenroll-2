<?php
namespace App\Http\View\Composers;

use App\Instructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InstructorComposer
{

    protected $instructor;

    public function __construct(Instructor $instructor)
    {
        $this->instructor = $instructor;
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
        if (str_contains(url()->current(),'/instructor/')) {
            $view->with('user_info',
                $this->instructor->where('id_number',Auth::user()->id_number)->first()
            );
        }

    }
}

?>