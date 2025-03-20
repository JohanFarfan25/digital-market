<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{


    /**
     * Redirecciona a la vista de roles 
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function index()
    {
        $roles = Role::all();
        return view('roles.rol', compact('roles'));
    }


    /**
     * Redirecciona a la vista de crear rol
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function viewCreate()
    {
        return view('roles/crear-rol');
    }



    /**
     * Creación de rol
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function create()
    {
        try {
            $attributes = request()->validate([
                'name' => ['required']
            ]);

            $role = Role::create($attributes);
            if ($role) {
                return getRedirect('roles');
            } else {
                return getRedirect('roles', 'error', '¡No se pudo crear el rol intente nuevamente!');
            }
        } catch (\Exception $e) {
            return getRedirect('crear-rol', 'error', '¡No se pudo crear el rol intente nuevamente!');
        }
    }


    /**
     * Redirecciona a la vista de rol
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function view($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('roles.vista-rol', compact('role','permissions'));
    }



    /**
     * Actualización de rol
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function update($id, Request $request)
    {
        $role = Role::find($id);
        $role->permissions()->sync($request->permissions);
        $permissions = Permission::all();
        return getResponse('roles.vista-rol', compact('role','permissions'), 'success', 'Los datos se han guardado correctamente.');
    }



    /**
     * Eliminación de rol
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function destroy($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return getRedirect('roles');
        } else {
           return getRedirect('roles', 'error', 'Rol no encontrado!');
        }
    }
}
