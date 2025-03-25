<?php
use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {

            $role = Role::create(['name' => env('ROLE_SUPER_ADMIN')]);
            $permission = Permission::create(['name' => 'All']);
            $role->givePermissionTo($permission);

            $dataAdmin = [
                'name' => env('ADMIN_DEFAULT'),
                'email' => env('EMAIL_ADMIN_DEFAULT'),
                'password' => bcrypt(env('PASSWORD_ADMIN_DEFAULT')),
                'rol_id' =>  $role->id,
                'status' => 1,
                'phone'     => env('PHONE_ADMIN_DEFAULT'),
                'location' => env('LOCATION_ADMIN_DEFAULT'),
                'about_me'    => env('ABOUT_ME_ADMIN_DEFAULT'),
            ];

            request()->roles = [$role->id];

            $user = User::create($dataAdmin);
            if (isset($user->id)) {

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
                print_r('Usuario Creado Exitosamente');
            } else {
                print_r('Email o password invalido.');
            }

        }  catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar el usuario si existe
        User::where('email', env('EMAIL_ADMIN_DEFAULT'))->delete();

        // Eliminar el rol y permiso
        Role::where('name', 'Super Admin')->delete();
        Permission::where('name', 'All')->delete();
    }
};