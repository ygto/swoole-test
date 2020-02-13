<?php


namespace App;


use Illuminate\Support\Arr;

class Config
{
    protected $conf;

    public function __construct($config)
    {
        $this->conf = $config;
    }

    public function get($name, $default = null)
    {
        return Arr::get($this->conf, $name, $default);
    }
}