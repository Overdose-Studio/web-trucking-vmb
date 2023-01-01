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
        'order_type',
        'client_id',
        'bill_id',
    ];

    public function bill() {
        return $this->belongsTo(Bill::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function getDateAttribute() {
        return $this->created_at->format('l, d F Y');
    }

    public function dailyTruckingPlan() {
        return $this->hasMany(DailyTruckingPlan::class);
    }

    public function dailyTruckingActually() {
        return $this->hasMany(DailyTruckingActually::class);
    }
}
