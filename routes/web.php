<?php

use App\Http\Controllers\{
	BillingController,
	HomeController,
	InfoUserController,
	UserManagementController,
	RoleController,
	PermissionController,
	ImageUploadController,
	SessionsController,
	ResetController,
	ChangePasswordController,
	ProductController,
	SalesBoxController,
	TransactionController
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

	//Productos
	Route::get('/productos', [ProductController::class, 'index'])->name('productos');
	Route::get('/crear-producto', [ProductController::class, 'viewCreate'])->name('crear-producto');
	Route::post('/crear-producto', [ProductController::class, 'create'])->name('crear-producto');
	Route::get('/vista-producto/{id}', [ProductController::class, 'view'])->name('vista-producto');
	Route::post('/vista-producto/{id}', [ProductController::class, 'update'])->name('vista-producto');
	Route::get('/eliminar-producto/{id}', [ProductController::class, 'destroy'])->name('eliminar-producto');

	//Transacciones
	Route::get('/transacciones', [TransactionController::class, 'index'])->name('transacciones');
	Route::get('/ver-transaccion/{id}', [TransactionController::class, 'view'])->name('ver-transaccion');
	Route::get('/eliminar-transaccion/{id}', [TransactionController::class, 'destroy'])->name('eliminar-transaccion');
	Route::get('/cancelar-transaccion/{transaction_id}', [TransactionController::class, 'cancelled'])->name('cancelar-transaccion');

	//facturación
	Route::get('/facturacion', [BillingController::class, 'index'])->name('facturacion');
	Route::get('/facturacion-compra', [BillingController::class, 'indexPurchase'])->name('facturacion-compra');
	Route::post('/crear-transaccion', [BillingController::class, 'store'])->name('crear-transaccion');
	Route::get('/buscar-productos', [BillingController::class, 'searchProducts'])->name('buscar-productos');
	Route::get('/proceso-de-pago/{transaction_id}', [TransactionController::class, 'payment'])->name('proceso-de-pago');
	Route::post('/proceso-de-pago', [TransactionController::class, 'paymentTransaction'])->name('payment.pay');

	//Sales Box
	Route::get('/validar-caja-abierta', [SalesBoxController::class, 'validateBoxOpenByUser'])->name('validar-caja-abierta');
	Route::get('/vista-caja', [SalesBoxController::class, 'view'])->name('vista-caja');
	Route::post('/abrir-caja', [SalesBoxController::class, 'openBox'])->name('abrir-caja');
	Route::post('/cerrar-caja/{id}', [SalesBoxController::class, 'closeBox'])->name('cerrar-caja');
	Route::get('/reporte-caja', [SalesBoxController::class, 'reporByDate'])->name('reporte-caja');
	Route::post('/reporte-caja', [SalesBoxController::class, 'reporByDate'])->name('reporte-caja');
	
});


Route::group(['middleware' => 'guest'], function () {
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/session', [SessionsController::class, 'dashboard']);
	Route::get('/login/contrasena-olvidada', [ResetController::class, 'create']);
	Route::post('/contrasena-olvidada', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
	Route::get('/crear-usuario-invitado', [UserManagementController::class, 'viewCreateGuest'])->name('crear-usuario-invitado');
	Route::post('/crear-usuario-invitado', [UserManagementController::class, 'storeGuest'])->name('crear-usuario-invitado');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
