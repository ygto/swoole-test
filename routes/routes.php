<?php
/**
 * @var $route FastRoute\RouteCollector
 */

$route->addRoute('GET', '/articles', [\App\Http\Controllers\HomeController::class, 'test']);