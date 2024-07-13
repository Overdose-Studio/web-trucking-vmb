<?php

namespace App\Http\Services;

use App\Enums\LogType;
use App\Models\Log;
use App\Models\Shipment;

class LogService
{
    // Create: creating a new log by logging the action and the user who performed the action.
    public function create(Shipment $shipment, LogType $type = LogType::UNKNOWN): Log
    {
        // Check user is authenticated
        if (!auth()->check()) {
            throw new \Exception('User is not authenticated');
        }

        // Create a new log
        $log = new Log();
        $log->shipment_id = $shipment->id;
        $log->user_id = auth()->id();
        $log->action = $type->value;
        $log->save();

        // Return the created log
        return $log;
    }
}