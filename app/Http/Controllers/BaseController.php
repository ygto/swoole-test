<?php


namespace App\Http\Controllers;


use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Table;

class BaseController
{

    protected $request;
    protected $response;
    protected $table;

    /**
     * BaseController constructor.
     * @param $request Request
     * @param $response Response
     * @param $table Table
     */
    public function __construct($request, $response, $table)
    {
        $this->request = $request;
        $this->response = $response;
        $this->table = $table;
    }

}