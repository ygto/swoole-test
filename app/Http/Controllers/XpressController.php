<?php


namespace App\Http\Controllers;


use App\Models\User;
use Swoole\Http\Response;

class XpressController
{

    /**
     * @param $request \Symfony\Component\HttpFoundation\Request
     * @param $response Response
     */
    public function seamless($request, $response)
    {
        $response->end("hello world");
    }

}