<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsOperatorMiddleware;
use App\Http\Middleware\IsSuperAdminMiddleware;
use App\Http\Middleware\CheckRoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->alias([
        //     'IsSuperAdmin' => IsSuperAdminMiddleware::class,
        //     'IsAdmin' => IsAdminMiddleware::class,
        //     'IsOperator' => IsOperatorMiddleware::class,
        // ]);

        $middleware->alias([
            'role' => CheckRoleMiddleware::class,
        ]);

        // $middleware->append(IsSuperAdmin::class);
        // $middleware->append(CheckRoleMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
