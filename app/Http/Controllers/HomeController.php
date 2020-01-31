<?php


namespace App\Http\Controllers;


class HomeController extends BaseController
{


    public function index()
    {
        $num = $this->table->get('num');
        ++$num['value'];
        $this->table->set("num", $num);

        $f = file_get_contents('../../../test.txt');

        return 'hello world!(' . $f . '):' . $num['value'];
    }
}