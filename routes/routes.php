<?php
/**
 * @var $route FastRoute\RouteCollector
 */

$route->addRoute('GET', '/articles', [\App\Http\Controllers\HomeController::class, 'test']);
$route->addRoute('GET', '/err', [\App\Http\Controllers\HomeController::class, 'err']);


$route->addRoute('POST', '/seamless', [\App\Http\Controllers\XpressController::class, 'seamless']);
$route->addRoute('GET', '/seamless', [\App\Http\Controllers\XpressController::class, 'seamless']);