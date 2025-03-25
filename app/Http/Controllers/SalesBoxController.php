<?php

namespace App\Http\Controllers;

use App\Models\SalesBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SalesBoxController extends Controller
{

    /**
     * Obtener la caja abierta por el usuario
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    private function getSessionOpenBox()
    {
        return SalesBox::where('status_box', 'open')
            ->where('registered_by', Auth::user()->id)
            ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
            ->first();
    }

    /**
     * Validar si el usuario tiene una caja abierta
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function validateBoxOpenByUser()
    {
        $status = 'success';
        $boxId = null;
        $box = $this->getSessionOpenBox();
        if (isset($box->id)) {
            $boxId = $box->id;
        } else {
            $status = 'error';
        }
        return response()->json(['status' => $status, 'boxId' => $boxId]);
    }


    /**
     * Abrir caja para el usuario logueado
     * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
     */
    public function openBox(Request $request)
    {
        try {

            $dataBox =  [
                'cash_initial' => is_numeric($request->cash_initial) ? (float) $request->cash_initial : 0.0,
                'base' => is_numeric($request->base) ? (float) $request->base : 0.0,
                'total' => is_numeric($request->total) ? (float) $request->total : 0.0,
                'status_box' => 'open',
                'status' => 'active',
                'registered_by' => Auth::user()->id
            ];

            $box = SalesBox::create($dataBox);

            return response()->json(['status' => 'success', 'message' => 'Caja abierta correctamente.', 'boxId' => $box->id]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
