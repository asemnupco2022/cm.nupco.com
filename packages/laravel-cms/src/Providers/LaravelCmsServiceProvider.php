<?php

namespace rifrocket\LaravelCms\Providers;


use Illuminate\Support\Facades\Schema;
use rifrocket\LaravelCms\Exception\LbsExceptionHandler;
use rifrocket\LaravelCms\Http\Livewire\LivewireControllerProvider;
use rifrocket\LaravelCms\Http\Middlewares\LbsAppSession;
use rifrocket\LaravelCms\Http\Middlewares\LbsHeaderMiddleware;
use rifrocket\LaravelCms\Http\Middlewares\LbsRedirectIfAuthenticated;
use rifrocket\LaravelCms\Http\Middlewares\LbsUserSession;
use rifrocket\LaravelCms\LaravelCms;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LaravelCmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'lbs-lang');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/lbs_admin_routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'LbsViews');


        /*
         * Load Middleware
         */
        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', LbsAppSession::class);
        $router->pushMiddlewareToGroup('api', LbsAppSession::class);

        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(LbsHeaderMiddleware::class);

        /*
        * Component Collection
        */
        $this->loadLivewireComponents();


        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../Config/lbs-laravel-cms.php' => config_path('lbs-laravel-cms.php'),
            ], 'lbs:config');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../Public' => public_path('vendor/lbs-cms-assets'),
            ], 'lbs:assets');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {

        //register helper alias
        $loader =AliasLoader::getInstance();
        $loader->alias('LbsConstants',"rifrocket\LaravelCms\Helpers\Classes\LbsConstants");

        $this->registerExceptionHandler();
//        app()->register(AuthServiceProvider::class);

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../Config/lbs-laravel-cms.php', 'lbs-laravel-cms.php');
        $this->mergeAuthFileFrom(__DIR__ . '/../Config/auth.php', 'auth');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-cms', function () {
            return new LaravelCms;
        });

        /*
         * Register Middleware
         */
        $this->loadMiddlewares();
    }


    //    Register Components
    public function loadLivewireComponents(){

        LivewireControllerProvider::adminComponentCollection();
    }

    //Middlewares
    public function loadMiddlewares()
    {
        app('router')->aliasMiddleware('auth_redirect', LbsRedirectIfAuthenticated::class);
//        app('router')->aliasMiddleware('userSession', LbsUserSession::class);
    }

    protected function registerExceptionHandler()
    {
        if(Schema::hasTable('lbs_settings')){
            app()->register(MailConfigServiceProvider::class);
        }

        \App::singleton(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            LbsExceptionHandler::class
        );
    }

    protected function mergeAuthFileFrom($path, $key)
    {
        $original = $this->app['config']->get($key, []);
        $this->app['config']->set($key, LaravelCms::lbs_multi_array_merge(require $path, $original));
    }




}
