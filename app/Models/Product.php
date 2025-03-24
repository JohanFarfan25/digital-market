<?php

namespace App\Models;

use App\Traits\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Para soporte de eliminación suave

class Product extends Model
{
    use SoftDeletes, GeneratesUuid; // Habilita la eliminación suave

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products'; // Nombre de la tabla en la base de datos

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'category',
        'unit_of_measure',
        'expiration_date',
        'purchase_price',
        'sale_price',
        'supplier',
        'quantity',
        'in_stock',
        'status',
        'registered_by',
        'modified_by',
        'image',
        'code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'expiration_date' => 'date', // Asegura que sea tratado como fecha
        'purchase_price' => 'decimal:2', // Asegura que sea tratado como decimal
        'sale_price' => 'decimal:2', // Asegura que sea tratado como decimal
        'status' => 'string', // Asegura que 'status' sea tratado como cadena
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expiration_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Obtener el usuario que registró el producto.
     */
    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}