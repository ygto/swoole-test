<?php
$http = new swoole_http_server("127.0.0.1", 9501);

$http->on("request", function ($request, $response) {

    $response->end('<html><body>Lucky number: ' . rand(1, 100) . '</body></html>');
});

$http->start();