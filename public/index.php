<?php

function base_path(string $path = ''): string
{
    return realpath(__DIR__ . '/../' . $path);
}

require base_path('bootstrap/autoload.php');

/**
 * @var $app \App\Application
 */
$app = require base_path('bootstrap/app.php');

$app->start();