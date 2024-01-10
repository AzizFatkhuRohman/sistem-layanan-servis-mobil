<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
    protected function configureRateLimiting()
    {
        RateLimiter::for('login', function (Request $request) {
            $limit = Limit::perMinute(2)->by($request->ip());
    
            if (RateLimiter::tooManyAttempts('login', $limit->maxAttempts)) {
                // $seconds = RateLimiter::availableIn('login:'.$request->ip());
    
                return redirect()->back()->withErrors(['throttle' => 'Anda telah melewati batas yang di tentukan']);
            }
    
            RateLimiter::hit('login', $limit->decayMinutes * 60);
    
            return $limit;
        });
    }
}
