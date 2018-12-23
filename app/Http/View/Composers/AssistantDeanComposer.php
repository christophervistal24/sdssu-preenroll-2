<?php
namespace App\Http\View\Composers;

use App\AssistantDean;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AssistantDeanComposer
{

    protected $assistant_dean;

    public function __construct(AssistantDean $assistant_dean)
    {
        $this->assistant_dean = $assistant_dean;
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
        if (str_contains(url()->current(),'/assistantdean/')) {
            $view->with('user_info',
                $this->assistant_dean->where('id_number',Auth::user()->id_number)->first()
            );
        }

    }
}

?>