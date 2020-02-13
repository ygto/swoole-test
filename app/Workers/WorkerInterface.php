<?php


namespace App\Workers;


interface WorkerInterface
{

    public function handle($process);
}