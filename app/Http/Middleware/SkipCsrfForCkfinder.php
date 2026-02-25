<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class SkipCsrfForCkfinder extends Middleware
{
    protected $except = [
        'ckfinder/connector',
        'ckfinder/connector/*',
        'ckfinder/browser',
        'ckfinder/browser/*',
    ];
}
