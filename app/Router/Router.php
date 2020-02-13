<?php


namespace App\Router;


use FastRoute\Dispatcher;

class Router
{
    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    /**
     * Router constructor.
     * @param $dispatcher
     */
    public function __construct($dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

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
        //var_dump($routeInfo);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                $response->end('404.');

                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                $response->end('404');
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $controller = $handler[0];
                $method = $handler[1];
                $params = $routeInfo[2] ?? [];

                $controllerResponse = (string)call_user_func([$controller, $method], $params);
                $response->end($controllerResponse);
        }
    }

}