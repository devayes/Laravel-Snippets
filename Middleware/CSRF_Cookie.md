# CSRF Cookie
Combined with a simple web middleware, it allows you to validate the csrf token on get requests (ie: delete, logout, etc.) without having to pass the csrf token in the url.

### BeforeMiddleware
```
<?php

namespace App\Http\Middleware;

use Closure;

class BeforeMiddleware {

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

    ];

    public function handle($request, Closure $next)
    {

        // Set it and reset it every time it changes (ie: login/logout)
        if (\Cookie::get('atok') != csrf_token()) {
            \Cookie::queue('atok', csrf_token(), 30);
        }

         // Skip all of this for ajax requests.
        if ($request->ajax()) {
            return $next($request);
        }

        return $next($request);
    }

}
```
Add to App/Http/Kernel.php
```
/**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            ........
            \App\Http\Middleware\BeforeMiddleware::class,
        ]
    ];
 ```

### jsCSRF Middleware
```
<?php

namespace App\Http\Middleware;

use Closure;

class jsCSRF  {

    public function handle($request, Closure $next)
    {
    	if (\Cookie::get('atok') !== csrf_token()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Security token validation failed.', 401);
            }
	        return back()->withError('Security token validation failed.. Try again.');
	    }

        return $next($request);
    }

}
```
Add to App/Http/Kernal.php
```
/**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        ........
        'jscsrf' => \App\Http\Middleware\jsCSRF::class,
    ];
```

Add to route middleware:
```
Route::get('logout', ['middleware' => 'jscsrf', 'as' => 'account.logout', 'uses' => 'AccountController@getLogout']);
```
