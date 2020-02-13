<?php

$app = new \App\Application();

/**
 * @param null $name
 * @return \App\Application|mixed
 */
function app($name = null)
{
    global $app;

    if ($name) {
        return $app->service($name);
    }

    return $app;
}

return $app;