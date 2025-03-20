<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * las rutas que no deben ser verificadas durante el mantenimiento
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @var array
     */
    protected $except = [
        //
    ];
}
