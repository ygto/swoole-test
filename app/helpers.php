<?php

/**
 * @return \App\Config|mixed
 */
function config($key = null)
{
    if ($key) {
        return app('config')->get($key);
    }

    return app('config');
}

/**
 * @return \Swoole\Table|null
 */
function table($name)
{
    return app('table')->get($name);
}


function logger($message)
{
    global $log;
    $log->info($message);
}