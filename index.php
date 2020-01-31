<?php
$http = new swoole_http_server("127.0.0.1", 9501);


$table = new Swoole\Table(1024);
$table->column('key', Swoole\Table::TYPE_STRING, 32);
$table->column('value', Swoole\Table::TYPE_STRING, 1024 * 100);
$table->column('expired_at', Swoole\Table::TYPE_INT);
$table->create();


$http->on("request", function ($request, $response) {

    $response->end('<html><body>Lucky number: ' . rand(1, 100) . '</body></html>');
});

$http->start();