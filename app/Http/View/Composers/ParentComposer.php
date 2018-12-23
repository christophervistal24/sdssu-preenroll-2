<?php
namespace App\Http\View\Composers;

use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ParentComposer
{

    protected $parent;

    public function __construct(Student $parent)
    {
        $this->parent = $parent;
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
        if (str_contains(url()->current(),'/parent/')) {
            $view->with('user_info',
                $this->parent->where('id_number',Auth::user()->id_number)->first()
            );
        }

    }
}

?>