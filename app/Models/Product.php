<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $fillable = [
        'code',
        'product_name',
        'description',
        'price',
        'stock',
        'picture',
        'insert_by',
        'suplier_id',
    ];
    
	public function insert_by()
	{
		return $this->belongsTo(User::class, 'insert_by');
	}

	public function suplier()
	{
		return $this->belongsTo(Suplier::class, 'suplier_id');
	}
    
}
