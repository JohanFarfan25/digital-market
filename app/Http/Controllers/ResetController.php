<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetController extends Controller
{

    /**
     * Retorna la vista para enviar el correo de recuperación de contraseña
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function create()
    {
        return view('session/reset-password/sendEmail');
        
    }


    /**
     * Envio de email para recuperación de contraseña (TODO:Credenciales del tercero para poder enviar correos)
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */ 
    public function sendEmail(Request $request)
    {
        if(env('IS_DEMO'))
        {
            return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t recover your password.']);
        }
        else{
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['success' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        }
    }

    public function resetPass($token)
    {
        return view('session/reset-password/resetPassword', ['token' => $token]);
    }
}
