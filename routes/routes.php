<?php
/**
 * @var $route FastRoute\RouteCollector
 */

$route->addRoute('GET', '/articles', [\App\Http\Controllers\HomeController::class, 'test']);
$route->addRoute('GET', '/err', [\App\Http\Controllers\HomeController::class, 'err']);