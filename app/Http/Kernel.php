<?php

namespace App\Http;

use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as EnsureEmailIsVerifiedMiddleware;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Middleware\HandleCors;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, \Closure|string>
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \App\Http\Middleware\EncryptCookies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * These groups may be used to assign middleware to specific routes.
     *
     * @var array<string, array<int, \Closure|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to individual routes or groups.
     *
     * @var array<string, \Closure|string>
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => ThrottleRequests::class,
        'verified' => EnsureEmailIsVerifiedMiddleware::class,
        'admin' => \App\Http\Middleware\AuthAdmin::class,

        // Custom middleware for email verification
        'email.verified' => \App\Http\Middleware\EnsureEmailIsVerified::class, // Register the custom middleware
    ];

    /**
     * The priority-sorted middleware stack for the application.
     *
     * This will determine the order in which middleware are applied to the request.
     *
     * @var array<int, \Closure|string>
     */
    protected $middlewarePriority = [
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Auth\Middleware\Authenticate::class,
        \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
    ];
}
