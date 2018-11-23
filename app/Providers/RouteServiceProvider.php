<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    // 前后台路由分离
    // protected $backendNamespace;
    // protected $frontendNamespace;
    // protected $apiNamespace;
    // protected $currentDomain;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        // 路由参数全局范围内正则表达式约束
        Route::pattern('id', '[0-9]+');

        // $this->backendNamespace = 'App\Http\Controllers\Backend';
        // $this->frontendNamespace = 'App\Http\Controllers\Frontend';
        // $this->apiNamespace = 'App\Http\Controllers\Api';
        // $this->currentDomain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        // $backendHost = config('route.backenHost');
        // $frontendHost = config('route.frontendHost');
        // $apiHost = config('route.apiHost');

        // switch ($this->currentDomain) {
        //     case $backendHost:
        //         $this->mapBackendRoutes();
        //         break;

        //     case $apiHost:
        //         $this->mapApiRoutes();
        //         break;

        //     default:
        //         $this->mapFrontendRoutes();
        //         break;
        // }
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    // protected function mapBackendRoutes($domain)
    // {
    //     Route::domain($domain)
    //          ->namespace($this->backendNamespace)
    //          ->group(base_path('routes/backend.php'));
    // }

    // protected function mapFrontendRoutes($domain)
    // {
    //     Route::domain($domain)
    //          ->namespace($this->frontendNamespace)
    //          ->group(base_path('routes/frontend.php'));
    // }

    // protected function mapApiRoutes($domain)
    // {
    //     Route::domain($domain)
    //          ->namespace($this->apiNamespace)
    //          ->group(base_path('routes/api.php'));
    // }
}
