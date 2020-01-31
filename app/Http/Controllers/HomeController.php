<?php


namespace App\Http\Controllers;


class HomeController extends BaseController
{


    public function index()
    {
        $num = $this->table->get('num');
        ++$num['value'];
        $this->table->set("num", $num);


        return 'hello world!:'.$num['value'];
    }
}