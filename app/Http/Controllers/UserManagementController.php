<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserManagementController extends Controller
{

    use HasRoles;


    /**
     * Redirecciona a la vista de usuarios
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)
            ->where('status', 1)
            ->get();

        return view('users.usuarios', compact('users'));
    }

    
    /**
     * Redirecciona a la vista de usuario
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function view($id, Request $request)
    {
        try {

            $user = User::find($id);
            $roles = Role::all();
            $response = [];

            $compact = compact('user', 'roles');

            if ($_POST && $user) {
                $attributes = request()->validate([
                    'name' => ['required', 'max:50'],
                    'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($id)],
                    'phone'     => ['max:50'],
                    'location' => ['max:70'],
                    'about_me'    => ['max:150'],
                    'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'warehouse_id' => ['nullable', 'exists:warehouses,id'],
                ]);

                if (request()->hasFile('profile_picture')) {
                    $profilePicture = ImageUploadController::upload($request->file('profile_picture'), 'profile_pictures', $user->uuid);
                    $attributes['profile_picture'] = !empty($profilePicture) ? $profilePicture : $user->profile_picture;
                }

                $user->update($attributes);

                // Eliminar roles previos antes de agregar los nuevos
                if ($user->roles()->exists()) {
                    $user->roles()->detach();
                }

                if (!empty($request->roles)) {
                    foreach ($request->roles as $role) {
                        $user->roles()->syncWithoutDetaching([
                            $role => [
                                'model_type' => get_class($user),
                                'team_id' => $id
                            ]
                        ]);
                    }
                }

                return getResponse('users.vista-usuario', $compact, 'success', 'Los datos se han guardado correctamente.');
            }

            return getResponse('users.vista-usuario', $compact);
        } catch (\Exception $e) {
            return getResponse('users.vista-usuario', 'error', $e->getMessage());
        }
    }



    /**
     * Redirecciona a la vista de crear usuario
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function viewCreate()
    {
        $roles = Role::all();
        return view('users/crear-usuario', compact('roles'));
    }



    /**
     * Creación de usuario
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function store()
    {
        try {
            $attributes = request()->validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
                'password' => ['required', 'min:5', 'max:20'],
                'phone'     => ['max:50'],
                'location' => ['max:70'],
                'about_me'    => ['max:150'],
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'warehouse_id' => ['nullable', 'exists:warehouses,id'],
            ]);
            $attributes['rol_id'] = 1;
            $attributes['password'] = bcrypt($attributes['password']);

            $user = User::create($attributes);
            if (isset($user->id)) {

                if (request()->hasFile('profile_picture')) {
                    $profilePicture = ImageUploadController::upload(request()->file('profile_picture'), 'profile_pictures', $user->uuid);
                    $user->profile_picture = !empty($profilePicture) ? $profilePicture : $user->profile_picture;
                    $user->save();
                }

                // Eliminar roles previos antes de agregar los nuevos
                if ($user->roles()->exists()) {
                    $user->roles()->detach();
                }


                if (!empty(request()->roles)) {
                    foreach (request()->roles as $role) {
                        $user->roles()->syncWithoutDetaching([
                            $role => [
                                'model_type' => get_class($user),
                                'team_id' => $user->id
                            ]
                        ]);
                    }
                }
                return getRedirect('usuarios');
            } else {
                return back()->withErrors(['email' => 'Email o password invalido.']);
            }
        } catch (\Exception $e) {
            $roles = Role::all();
            return getResponse('users/crear-usuario', compact('roles'),'error', $e->getMessage());
        }
    }


    /**
     * Actualización de usuario
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function update(Request $request)
    {
        try {
            $attributes = request()->validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
                'phone'     => ['max:50'],
                'location' => ['max:70'],
                'about_me'    => ['max:150'],
            ]);
            if ($request->get('email') != Auth::user()->email) {
                //Sección para el rol
                if (env('IS_DEMO') && Auth::user()->id == 1) {
                    return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
                }
            } else {
                $attribute = request()->validate([
                    'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
                ]);
            }


            User::where('id', Auth::user()->id)
                ->update([
                    'name'    => $attributes['name'],
                    'email' => $attribute['email'],
                    'phone'     => $attributes['phone'],
                    'location' => $attributes['location'],
                    'about_me'    => $attributes["about_me"],
                    'warehouse_id' => $attributes["warehouse_id"],
                ]);

            return redirect('/perfil');
        } catch (\Exception $e) {
            return getResponse('perfil', 'error', $e->getMessage());
        }
    }


    /**
     * Eliminación de usuario
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return getRedirect('usuarios');
        } else {
            return getRedirect('usuarios');
        }
    }
}
