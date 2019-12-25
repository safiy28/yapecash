<?php
namespace App\Facades\HttpClient;

use Illuminate\Support\Facades\Facade;

abstract class Http extends Facade {
    protected static function getFacadeAccessor() {
        return 'Http';
    }
}