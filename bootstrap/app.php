<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(function (Request $request) {
            // Check if the request is for accounting routes
            if ($request->is('accounting/*')) {
                return route('accounting.login');
            }
            // Check if the request is for registrar routes
            if ($request->is('registrar/*')) {
                return route('registrar.login');
            }
            // Check if the request is for admission routes
            if ($request->is('admission/*')) {
                return route('admission.login');
            }
            // Check if the request is for department routes
            if ($request->is('department/*')) {
                return route('department.login');
            }
            // Check if the request is for admin routes
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            // Default redirect
            return route('index');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
