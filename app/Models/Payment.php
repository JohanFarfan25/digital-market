<?php

namespace App\Models;

use App\Traits\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes,GeneratesUuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'payment_type',
        'note',
        'status',
        'box_id',
        'voucher_number',
        'bank',
        'transaction_id',
        'card_cd',
        'franchise',
        'payment_status',
        'payment_date',
        'payment_reason_rejection',
        'registered_by',
        'edited_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',
        'payment_status' => 'integer',
        'payment_date' => 'datetime',
    ];


    /**
     * Get the user who registered the payment.
     */
    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    /**
     * Get the user who last edited the payment.
     */
    public function editedBy()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

    /**
     * Get the transaction associated with the payment.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}