<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{

    use HasFactory;

    protected $fillable = [
        'supplier_code',
        'name',
        'address',
        'pic',
        'phone_number',
        'npwp',
    ];
    
}
