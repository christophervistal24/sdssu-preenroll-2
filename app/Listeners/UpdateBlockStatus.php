<?php

namespace App\Listeners;

use App\Events\UpdateBlock;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateBlockStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdateBlock  $event
     * @return void
     */
    public function handle(UpdateBlock $event)
    {
        $b = $event->block->find($event->block_id);
        if ($b->no_of_enrolled ==  $b->block_limit) {
            $b->status = 'closed';
        } else {
            $b->status = 'open';
        }
       $b->save();
    }
}
