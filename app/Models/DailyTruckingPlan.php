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
        'driver_name',
        'size',
        'price',
        'is_vendor_truck',
        'truck_id',
    ];

    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }

    public function dailyTruckingActually() {
        return $this->hasOne(DailyTruckingActually::class);
    }

    public function destination1() {
        return $this->belongsTo(Destination::class, 'destination_1_id');
    }

    public function destination2() {
        return $this->belongsTo(Destination::class, 'destination_2_id');
    }

    public function destination3() {
        return $this->belongsTo(Destination::class, 'destination_3_id');
    }

    public function truck() {
        return $this->belongsTo(Truck::class);
    }
}
