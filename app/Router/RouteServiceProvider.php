<?php


namespace App\Router;


use App\Providers\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $router;

    public function register()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $route) {
            require base_path('routes/routes.php');
        });
        $this->router = new Router($dispatcher);
        app()->addService('router.dispatcher', $this->router);
    }

    public function boot()
    {
        $server = app('server');
        if ($server) {
            $server->on("request", [$this->router, 'request']);
        }
    }
}