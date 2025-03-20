<?php


/**
 * maneja las respuestas de las vistas.
 * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
 */
if (!function_exists('getResponse')) {
    function getResponse($view, $compact = [], $status = '', $message = '')
    {
        if (empty($compact)) {
            $response =  view($view);
        } elseif (!empty($message)) {
            $response = view($view, $compact)->with('response', [
                'status' => $status,
                'message' => $message
            ]);
        } else {
            $response = view($view, $compact);
        }
        return $response;
    }
}

/**
 * maneja las redirecciones de las vistas.
 * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
 */
if (!function_exists('getRedirect')) {
    function getRedirect($route, $status = '', $message = '')
    {
        if (!empty($message)) {
            $response = redirect()->route($route)->with('response', [
                'status' => $status,
                'message' => $message
            ]);
        } else {
            $response = redirect()->route($route);
        }
        return $response;
    }
}
