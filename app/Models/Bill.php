<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'name',
        'address',
        'person_in_charge',
        'status',
        'note',
        'invoice',
    ];

    public function shipments() {
        return $this->hasMany(Shipment::class);
    }
}
