<?php

namespace App\Http\Controllers;

use App\Models\FeedBack;
use Illuminate\Support\Facades\Auth;

class FeedBackController extends Controller
{

    /**
     * redirecciona a la vista de feedback
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function store()
    {

        $attributes = request()->validate([
            'rating' => ['required'],
            'comments' => ['required']
        ]);
        $attributes['registered_by'] = Auth::user()->id;
        FeedBack::create($attributes);

        return (new HomeController)->dashboard('success', 'Gracias por dejarnos tu opinión', true);
    }
}
