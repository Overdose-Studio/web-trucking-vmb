<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyTruckingActually extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'shipment_id',
        'daily_trucking_plan_id',
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

    public function dailyTruckingPlan() {
        return $this->belongsTo(DailyTruckingPlan::class);
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

    public function getDiffAttribute() {
        return $this->dailyTruckingPlan->price - $this->price;
    }

    public function truck() {
        return $this->belongsTo(Truck::class);
    }
}
