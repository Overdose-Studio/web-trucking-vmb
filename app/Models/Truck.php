<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Truck extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'license_plate',
        'brand',
        'production_year',
        'last_maintenance',
        'state_id',
    ];

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function dailyTruckingPlans() {
        return $this->hasMany(DailyTruckingPlan::class);
    }

    public function dailyTruckingActually() {
        return $this->hasMany(DailyTruckingActually::class);
    }

    public function getLastMaintenanceDateAttribute() {
        return date('l, d F Y', strtotime($this->last_maintenance));
    }
}
