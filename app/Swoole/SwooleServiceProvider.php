<?php


namespace App\Swoole;


use App\Providers\ServiceProvider;
use Swoole\Http\Server;
use Swoole\Process;

class SwooleServiceProvider extends ServiceProvider
{

    /**
     * @var Server
     */
    protected $server;
    protected $config;

    public function register()
    {
        $this->config = config("server");
        $this->server = new Server($this->config['host'], $this->config['port']);
        $this->server->set($this->config['settings']);
        app()->addService('server', $this->server);
    }

    public function start()
    {
        $workers = $this->config['workers'] ?? [];
        foreach ($workers as $class) {

            $process = new Process(function ($process) use ($class) {
                $worker = new $class();
                $worker->handle($process);
            });

            $this->server->workers[] = $process->start();
        }
        $this->server->start();
    }
}