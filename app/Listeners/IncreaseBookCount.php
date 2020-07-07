<?php

namespace App\Listeners;

use App\Events\UserReadBook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseBookCount
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
     * @param  UserReadBook  $event
     * @return void
     */
    public function handle(UserReadBook $event)
    {
        if (\Auth::guard('reader')->user()) {
            \Auth::guard('reader')->user()->books()->attach([$event->book->id => ['date_read' =>  date('Y-m-d H:m:s')]]);
          }
    }
}
