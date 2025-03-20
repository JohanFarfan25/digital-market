<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * los nombres de las cookies que no deben ser cifradas
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @var array
     */
    protected $except = [
        //
    ];
}
