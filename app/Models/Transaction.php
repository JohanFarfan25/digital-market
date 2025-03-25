<?php

namespace App\Models;

use App\Traits\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Para soporte de eliminación suave

class Transaction extends Model
{
    use SoftDeletes, GeneratesUuid; // Habilita la eliminación suave

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions'; // Nombre de la tabla en la base de datos

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'box_id',
        'type',
        'date',
        'quantity',
        'price',
        'customer',
        'supplier',
        'status',
        'registered_by',
        'transaction_status',
        'reson_rejection',
        'expiration_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'datetime', // Asegura que sea tratado como fecha y hora
        'quantity' => 'integer', // Asegura que sea tratado como entero
        'price' => 'decimal:2', // Asegura que sea tratado como decimal con 2 decimales
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
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
        'expiration_date'
    ];

    /**
     * Obtener el usuario que registró la transacción.
     */
    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }


    public function box()
    {
        return $this->belongsTo(SalesBox::class, 'box_id');
    }
}
