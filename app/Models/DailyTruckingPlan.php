<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTruckingPlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shipment_id',
        'destination_1_id',
        'destination_2_id',
        'destination_3_id',
        'price',
        'order_type',
        'client_id',
        'truck_id',
    ];
}
