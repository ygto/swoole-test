<?php


namespace App\Http\Controllers;


use App\Models\User;

class HomeController
{

    public function test()
    {
        $u = User::first();
        $user = table('users');
        $count = $user->get('yigit', 'count');
        return sprintf('hello %s:(%s)-%s', $u->username, $count,getenv('APP_KEY'));
    }

}