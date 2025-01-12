<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'check-type' => \App\Http\Middleware\CheckTypeUser::class,
          'last-active' =>  App\Http\Middleware\UserLastActive::class




            ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
