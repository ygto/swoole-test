<?php
require './vendor/autoload.php';


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    require './routes.php';
});

$http = new swoole_http_server("127.0.0.1", 9501);


$table = new Swoole\Table(1024);
$table->column('key', Swoole\Table::TYPE_STRING, 32);
$table->column('value', Swoole\Table::TYPE_STRING, 1024 * 100);
$table->column('expired_at', Swoole\Table::TYPE_INT);
$table->create();

$table->set("num", ['key' => 'num', 'value' => 0, 'expired_at' => time()]);

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

    public function request($request, $response)
    {

        var_dump([
            get_class($request),
            get_class($response),
        ]);

        /*
        // Fetch method and URI from somewhere
                $httpMethod = $_SERVER['REQUEST_METHOD'];
                $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
                if (false !== $pos = strpos($uri, '?')) {
                    $uri = substr($uri, 0, $pos);
                }
                $uri = rawurldecode($uri);

                $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);
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
                        $vars = $routeInfo[2];
                        // ... call $handler with $vars
                        break;
                }*/


        $num = $this->table->get('num');
        ++$num['value'];
        $this->table->set("num", $num);

        $response->header("Access-Control-Allow-Origin", $request->header['origin']);
        $response->header("Access-Control-Expose-Headers", "Auth");
        $response->header("Access-Control-Allow-Credentials", "true");
        $response->header("Content-Type", "application/json");
        $response->header("Serv", "NLE0.9-1");
        $response->status(200);
        $response->end(\json_encode($num));
    }
}

$controller = new Controller($table);

$http->on("request", [$controller, 'request']);

$http->start();