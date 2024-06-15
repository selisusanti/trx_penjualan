<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EventLogs extends Model
{

    use HasFactory;

	protected $table = 'event_log';
    protected $fillable = [
        'event_name',
        'event_module',
        'data_raw',
        'created_by',
    ];
    
	public function users()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

}
