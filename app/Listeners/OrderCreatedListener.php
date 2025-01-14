<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCreated;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        // $order = $event->order;

        // $user = User::where('store_id','=',$order->store_id)->first();
        // $user->notify(new OrderCreatedNotification($order));




    }
}
