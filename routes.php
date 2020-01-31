<?php

use FastRoute\RouteCollector;

/**
 * @var $route RouteCollector
 */


$route->addRoute('GET', '/users', 'get_all_users_handler');
// {id} must be a number (\d+)
$route->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
// The /{title} suffix is optional
$route->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');