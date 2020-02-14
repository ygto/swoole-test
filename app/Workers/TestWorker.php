<?php


namespace App\Workers;


class TestWorker implements WorkerInterface
{

    public function handle($process)
    {
        $user = table('users');
        $user->set('yigit', ['id' => 1, 'name' => 'yigit', 'count' => 0]);
        while (true) {
            sleep(1);
            //echo '.';
            $c = $user->get('yigit', 'count');
            $user->set('yigit', ['count' => $c + 1]);
        }
        // TODO: Implement handle() method.
    }
}