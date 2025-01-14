<?php
namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\EmptyCart;
use App\Listeners\OrderCreatedListener;
use App\Listeners\DeductProductQuantity;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// <- there

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [

        // 'cart' => [
        //     DeductProductQuantity::class,
        //     EmptyCart::class
        // ],

        OrderCreated::class =>
        [
            DeductProductQuantity::class,
            OrderCreatedListener::class
        ],

    ];

}
