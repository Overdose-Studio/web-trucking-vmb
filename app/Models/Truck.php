<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

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

    public function getLastMaintenanceDetailAttribute() {
        return date('d F Y - H:i:s', strtotime($this->last_maintenance));
    }
}
