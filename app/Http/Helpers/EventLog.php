<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Models\EventLogs;

class EventLog
{
    public static function insertLog($email,$reason,$dataraw,$model) {
        
        $inser_log = EventLogs::create([
            'event_name' => $reason.' '.$email,
            'event_module' => $model,
            'data_raw' => $dataraw,
            'created_by' => auth()->user()->id
        ]);

        return $inser_log;

    }

}