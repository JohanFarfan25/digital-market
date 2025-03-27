<?php

namespace App\Models;

use App\Traits\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    use HasFactory, GeneratesUuid;

    protected $fillable = [
        'rating',
        'comments',
        'registered_by'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
