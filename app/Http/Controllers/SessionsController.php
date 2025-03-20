<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{

    /**
     * Retorna la vista para iniciar sesión
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function create()
    {
        return view('session.login-session');
    }


    /**
     * Creación de sesión
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            return (new HomeController)->dashboard();
        } else {
            return back()->withErrors(['email' => 'Email o password invalido.']);
        }
    }


    /**
     * Retorna la vista dashboard si el usuario esta autenticado, de lo contrario redirecciona al login
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function dashboard()
    {
        if (Auth::check()) {
            return (new HomeController)->dashboard();
        } else {
            $this->destroy();
        }
    }


    /**
     * Cierre de sesión y redirecciona al login
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success' => 'Hasta la proxima.']);
    }
}
