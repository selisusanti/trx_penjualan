<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use HasFactory;

	protected $table = 'transaction';
    protected $fillable = [
        'users_id',
        'product_id',
        'quantity',
        'transaction_date',
    ];
    
	public function users()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id')->with('suplier');
	}
    
}
