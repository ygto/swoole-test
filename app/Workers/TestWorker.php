<?php


namespace App\Workers;


class TestWorker implements WorkerInterface
{

    public function handle($process)
    {
        $q = table('queue');
        while (true) {
            sleep(1);
            $q->set(time(), ['id' => 1, 'name' => 'yigit', 'count' => 0]);
        }
        // TODO: Implement handle() method.
    }
}