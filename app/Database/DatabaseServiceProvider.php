<?php


namespace App\Database;


use App\Providers\ServiceProvider;
use Illuminate\Database\Capsule\Manager;

class DatabaseServiceProvider extends ServiceProvider
{

    public function register()
    {
        $capsule = new Manager();
        $dbConfig = config('database');
        $capsule->addConnection($dbConfig);
        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }

}