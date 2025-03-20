<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Las asignaciones de políticas para la aplicación.
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registra cualquier servicio de autenticación/autorización.
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
