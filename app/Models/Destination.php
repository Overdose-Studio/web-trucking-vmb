<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'detail',
        'image'
    ];

    public function dailyTruckingPlan() {
        return $this->hasOne(DailyTruckingPlan::class);
    }
}
