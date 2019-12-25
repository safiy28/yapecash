<?php

namespace App\Facades\Logger;


use Illuminate\Support\Facades\Facade;

class Log extends Facade {
    protected static function getFacadeAccessor() {
        return 'Log';
    }
}