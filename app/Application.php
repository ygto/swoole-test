<?php


namespace App;


use App\Providers\ServiceProvider;

class Application
{


    /**
     * @var ServiceProvider[]
     */
    protected $providers = [];
    protected $services = [];

    public function __construct()
    {
        $config = require base_path('config/app.php');
        $this->addService('config', new Config($config));
        foreach ($this->service('config')->get('providers') as $provider) {
            $this->providers[] = new $provider();
        }
    }

    public function addService(string $name, $service)
    {
        $this->services[$name] = $service;
    }

    public function service($name)
    {
        return $this->services[$name];
    }

    private function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $provider->register();
        }
    }

    private function bootProviders()
    {
        foreach ($this->providers as $provider) {
            $provider->boot();
        }
    }


    private function startProviders()
    {
        foreach ($this->providers as $provider) {
            $provider->start();
        }
    }


    public function start()
    {
        $this->registerProviders();
        $this->bootProviders();
        $this->startProviders();
    }
}