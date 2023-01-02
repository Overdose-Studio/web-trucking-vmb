<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use HasFactory, SoftDeletes;

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

    public function getDiffAttribute() {
        return $this->dailyTruckingPlan->sum('price') - $this->dailyTruckingActually->sum('price');
    }

    public function getDateAttribute() {
        return $this->created_at->format('l, d F Y');
    }

    public function getDeadlineAttribute() {
        // Diff days with wednesday
        $diff = $this->created_at->diffInDays($this->created_at->next('Wednesday'));

        // Diff now to created_at next wednesday
        $deadline = now()->diffInDays($this->created_at->next('Wednesday'));

        // Check now after created_at next wednesday
        if (now()->isAfter($this->created_at->next('Wednesday'))) {
            return $deadline;
        } else {
            return $deadline * -1;
        }
    }

    public function getDeadlineStatusAttribute() {
        if ($this->deadline > -3) {
            return 'danger';
        } else if ($this->deadline > -5) {
            return 'warning';
        } else {
            return 'success';
        }
    }

    public function dailyTruckingPlan() {
        return $this->hasMany(DailyTruckingPlan::class);
    }

    public function dailyTruckingActually() {
        return $this->hasMany(DailyTruckingActually::class);
    }
}
