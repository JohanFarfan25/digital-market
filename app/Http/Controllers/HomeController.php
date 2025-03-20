<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Redirecciona a la vista dashboard
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function home()
    {
        return redirect('dashboard');
    }


    /**
     * Redirecciona a la vista dashboard
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function dashboard()
    {
        return view('dashboard')->with(['success' => 'Bienvenido.']);
    }
}
