<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    /**
     * Redirecciona a la vista de permisos
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function view()
    {
        $permissions = Permission::all();
        return view('permissions.permisos', compact('permissions'));
    }

    /**
     * Redirecciona a la vista de crear permiso
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function viewCreate()
    {
        return view('permissions/crear-permiso');
    }


    /**
     * Creación de permiso
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function create()
    {
        try {
            $attributes = request()->validate([
                'name' => ['required']
            ]);

            $permissions = Permission::create($attributes);
            if ($permissions) {
                return getRedirect('permisos');
            } else {
                return getRedirect('permisos', 'error', '¡No se pudo crear el permiso intente nuevamente!');
            }
        } catch (\Exception $e) {
            return getRedirect('/crear-permiso', 'error', $e->getMessage());
        }
    }


    /**
     * Eliminación de permiso
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function destroy($id)
    {
        $permissions = Permission::find($id);
        if ($permissions) {
            $permissions->delete();
            return getRedirect('permisos', 'success', 'Permiso eliminado Correctamente!');
        } else {
            return getRedirect('permisos', 'error', 'Permiso no encontrado!');
        }
    }
}
