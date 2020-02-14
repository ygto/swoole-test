<?php


namespace App\Http\Controllers;



use App\Models\User;
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
        sleep(1);
        $user = table('users');
        $count = $user->get('yigit', 'count');
        $response->end("hello world:".$count);
    }

}