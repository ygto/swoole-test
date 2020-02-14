<?php


namespace App\Http\Controllers;



use Swoole\Http\Request;
use Swoole\Http\Response;

class XpressController
{


    /**
     * @param Request $request
     * @param Response $response
     */
    public function seamless(Request $request, Response $response)
    {
        $response->status(500);
        $response->end("hello world");
    }

}