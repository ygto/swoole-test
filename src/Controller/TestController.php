<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class TestController
{

    public function test()
    {
        return new Response(
            '<html><body>Lucky number: ' . rand(1, 100) . '</body></html>'
        );
    }
}