<?php


namespace App\Providers;

use Illuminate\Auth\Events\Registered;

//Evento y oyente para guardar el carrito de compras en una tabla cuando cerramos la sesion
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;


use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\Product;
use App\Observers\ProductObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        //Definir estos dos eventos
        //despues eejcutar => php artisan event:generate
        Login::class =>  [
            "App\Listeners\MergeTheCart"
        ],

        Logout::class =>  [
            "App\Listeners\MergeTheCartLogout"
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //Registrar un observador para algun modelo, en este caso el modelo product

        Product::observe(ProductObserver::class);
    }
}
