<?php
$server = new Swoole\Server("127.0.0.1", 9501, SWOOLE_BASE, SWOOLE_SOCK_TCP);

$server->on("request", function($request, $response){

    $response->end('<html><body>Lucky number: ' . rand(1, 100) . '</body></html>');
});

$server->start();
