<?php
require './vendor/autoload.php';


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    require './routes.php';
});

$server = new Swoole\Http\Server("127.0.0.1", 9501);


$table = new Swoole\Table(1024);
$table->column('key', Swoole\Table::TYPE_STRING, 32);
$table->column('value', Swoole\Table::TYPE_STRING, 1024 * 100);
$table->column('expired_at', Swoole\Table::TYPE_INT);
$table->create();

$table->set("num", ['key' => 'num', 'value' => 0, 'expired_at' => time()]);


$testProcess= new \Swoole\Process(function ($process) use($table){
    while(true){
        echo '.';
        $this->table->set("num", ['key' => 'num', 'value' => 0, 'expired_at' => time()]);
        sleep(10);
    }
});
$server->workers[]=$testProcess->start();


class Controller
{
    protected $table;
    /**
     * @var \FastRoute\Dispatcher
     */
    protected $dispatcher;

    public function __construct($dispatcher, $table)
    {
        $this->dispatcher = $dispatcher;
        $this->table = $table;
    }

    /**
     * @param $request \Swoole\Http\Request
     * @param $response \Swoole\Http\Response
     */
    public function request($request, $response)
    {

        //var_dump($request);
        // Fetch method and URI from somewhere
        $serverMethod = $request->server['request_method'];
        $uri = $request->server['request_uri'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $this->dispatcher->dispatch($serverMethod, $uri);
        var_dump($routeInfo);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $controller = $handler[0];
                $method = $handler[1];
                $params = $routeInfo[2] ?? [];
                $controller = new $controller($request, $response, $this->table);
                $controllerResponse = call_user_func([$controller, $method], $params);
                $response->end($controllerResponse);

        }
/*
        $num = $this->table->get('num');
        ++$num['value'];
        $this->table->set("num", $num);

        $response->header("Access-Control-Allow-Origin", $request->header['origin']);
        $response->header("Access-Control-Expose-Headers", "Auth");
        $response->header("Access-Control-Allow-Credentials", "true");
        $response->header("Content-Type", "application/json");
        $response->header("Serv", "NLE0.9-1");
        $response->status(200);
        $response->end(\json_encode($num));*/
    }
}

$controller = new Controller($dispatcher, $table);

$server->on("request", [$controller, 'request']);

$server->start();