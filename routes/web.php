<?php

use App\Http\Controllers\{
	HomeController,
	InfoUserController,
	UserManagementController,
	RoleController,
	PermissionController,
	ImageUploadController,
	SessionsController,
	ResetController,
	ChangePasswordController
};

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('/logout', [SessionsController::class, 'destroy']);

	//Perfil de usuario logueado
	Route::get('/perfil-usuario', [InfoUserController::class, 'view'])->name('perfil-usuario');
	Route::post('/perfil-usuario', [InfoUserController::class, 'update'])->name('perfil-usuario');
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

	//Usuarios
	Route::get('/usuarios', [UserManagementController::class, 'index'])->name('usuarios');
	Route::get('/crear-usuario', [UserManagementController::class, 'viewCreate'])->name('crear-usuario');
	Route::post('/crear-usuario', [UserManagementController::class, 'store'])->name('crear-usuario');
	Route::get('/vista-usuario/{id}', [UserManagementController::class, 'view'])->name('vista-usuario');
	Route::post('/vista-usuario/{id}', [UserManagementController::class, 'view'])->name('vista-usuario');
	Route::get('/eliminar-usuario/{id}', [UserManagementController::class, 'destroy'])->name('eliminar-usuario');
	Route::post('/upload', [ImageUploadController::class, 'upload']);

	//Roles
	Route::get('/roles', [RoleController::class, 'index'])->name('roles');
	Route::get('/crear-rol', [RoleController::class, 'viewCreate'])->name('crear-rol');
	Route::post('/crear-rol', [RoleController::class, 'create'])->name('crear-rol');
	Route::get('/vista-rol/{id}', [RoleController::class, 'view'])->name('vista-rol');
	Route::post('/editar-rol/{id}', [RoleController::class, 'update'])->name('editar-rol');
	Route::get('/eliminar-rol/{id}', [RoleController::class, 'destroy'])->name('eliminar-rol');

	//Permisos
	Route::get('/permisos', [PermissionController::class, 'view'])->name('permisos');
	Route::get('/crear-permiso', [PermissionController::class, 'viewCreate'])->name('crear-permiso');
	Route::post('/crear-permiso', [PermissionController::class, 'create'])->name('crear-permiso');
	Route::get('/eliminar-permiso/{id}', [PermissionController::class, 'destroy'])->name('eliminar-permiso');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/session', [SessionsController::class, 'dashboard']);
	Route::get('/login/contrasena-olvidada', [ResetController::class, 'create']);
	Route::post('/contrasena-olvidada', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
