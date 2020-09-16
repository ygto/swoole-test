<?php


namespace App\Http\Controllers;


use App\Models\User;

class HomeController
{

    public function count()
    {
        $queue = table('queue');
        $count = $queue->count();

        return sprintf('queue count:%s', $count);
    }

    public function produce()
    {
        $q = table('queue');
        $t = time();
        $q->set($t, ['id' => $t, 'name' => \base64_encode(random_bytes(5))]);
    }

}