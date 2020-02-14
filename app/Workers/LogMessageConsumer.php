<?php


namespace App\Workers;


class LogMessageConsumer implements WorkerInterface
{


    public function handle($process)
    {
        $chan = new \Swoole\Coroutine\Channel(100000);
        $process = new \Swoole\Process(function ($worker) use ($chan) {

            while (true) {
                $arr = [];
                while ($data = $chan->pop()) {
                    $arr = $data;
                }
                echo sprintf("send(%s)\n", count($arr));
                \Co::sleep(5000);
                $arr = [];
            }

        }, false, true);

        $process->start();

        while (true) {
            \Co::sleep(1);
            $chan->push("hello world");
        }
        echo 'noo';
    }
}