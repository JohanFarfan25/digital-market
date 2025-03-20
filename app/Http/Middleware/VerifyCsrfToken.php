<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * las rutas que no deben ser verificadas por CSRF
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @var array
     */
    protected $except = [
        //
    ];
}
