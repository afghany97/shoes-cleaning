<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Locker;

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
        $freeLocker = Locker::free()->progress()->unDeleted()->first();

        if($freeLocker){

            $event->order->storeAt($freeLocker);

            $freeLocker->keep($event->order);
        }
    }
}
