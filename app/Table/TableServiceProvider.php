<?php


namespace App\Table;


use App\Providers\ServiceProvider;

class TableServiceProvider extends ServiceProvider
{

    public function register()
    {
        $table = new Table(config('tables'));

        app()->addService('table', $table);
    }
}