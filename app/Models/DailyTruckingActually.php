<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTruckingActually extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'daily_trucking_plan_id',
        'destination_1_id',
        'destination_2_id',
        'destination_3_id',
        'price',
        'renban',
        'container_size',
    ];

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
}
