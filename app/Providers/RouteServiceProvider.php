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
     * La ruta a la ruta "de inicio" para su aplicación.
     *
     * Laravel utiliza esta autenticación para redirigir a los usuarios después de iniciar sesión.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * El espacio de nombres del controlador para la aplicación.
     *
     * Cuando esté presente, las declaraciones de ruta del controlador se prefijarán automáticamente con este espacio de nombres.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define los enlaces de tu modelo de ruta, filtros de patrones, etc.
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure los limitadores de velocidad para la aplicación.
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
