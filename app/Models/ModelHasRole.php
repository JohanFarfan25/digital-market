<?php

namespace App\Models;

use App\Traits\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelHasRole extends Pivot
{
    use HasFactory, GeneratesUuid;


    protected $table = 'model_has_roles';


    protected $fillable = [
        'model_id',
        'role_id',
        'team_id',
        'model_type'
    ];


    public $timestamps = false;
}
