<?php
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

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function request($request, $response)
    {
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