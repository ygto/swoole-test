<?php
/**
 * @var $route FastRoute\RouteCollector
 */

$route->addRoute('GET', '/count', [\App\Http\Controllers\HomeController::class, 'count']);
$route->addRoute('GET', '/produce', [\App\Http\Controllers\HomeController::class, 'produce']);
$route->addRoute('GET', '/err', [\App\Http\Controllers\HomeController::class, 'err']);  