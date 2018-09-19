<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Locker;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InitLockerToOrder
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
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $freeLocker = Locker::where([['status',config('locker.status.free')],'type' => config('locker.type.progress')])->unDeleted()->first();

        if($freeLocker){

            $event->order->storeAt($freeLocker);

            $freeLocker->keep($event->order);

        }else{
            // this part shouldn't be here
            // what should todo "notify user is there is no free lockers"
        }
    }
}
