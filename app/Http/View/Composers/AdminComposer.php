<?php
namespace App\Http\View\Composers;

use App\Admin;
use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminComposer
{

    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //for the shared view which is student evaluate in order to display their names
        if (str_contains(url()->current(),['/admin/'])) { // for admin routes
            $view->with('user_info',$this->admin->where('id_number',Auth::user()->id_number)->first());
        } else if (str_contains(url()->current(),['/parent/'])) { // for parent routes
            $view->with('user_info',Student::where('id_number',Auth::user()->id_number)->first());
        } else if (str_contains(url()->current(),['/student/'])) { // for student routes
            $view->with('user_info',Student::where('id_number',Auth::user()->id_number)->first());
        }

    }
}

?>