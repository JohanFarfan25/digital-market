<?php
/**
 * Configuración de Cloudinary.
 * @author Johan Alexander Farfán Sierra <johanfarfan25@gmail.com>
 */
return [
    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    'api_key'    => env('CLOUDINARY_API_KEY'),
    'api_secret' => env('CLOUDINARY_API_SECRET'),
    'secure'     => true,
];
