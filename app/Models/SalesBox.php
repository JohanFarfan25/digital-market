<?php

namespace App\Models;

use App\Traits\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesBox extends Model
{
    use HasFactory, SoftDeletes, GeneratesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_box';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'cash_initial',
        'base',
        'total',
        'warehouse_id',
        'status_box',
        'status',
        'registered_by',
        'edited_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status_box' => 'string',
        'status' => 'string',
    ];

    /**
     * Get the user who registered the sales box.
     */
    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    /**
     * Get the user who last edited the sales box.
     */
    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id', 'box_id');
    }
}
