<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
    ];

    public function bill() {
        return $this->hasOne(Bill::class);
    }

    public function dailyTruckingPlan() {
        return $this->hasOne(DailyTruckingPlan::class);
    }
}
