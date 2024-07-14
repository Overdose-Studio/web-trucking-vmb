<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shipment_id',
        'user_id',
        'action',
        'date',
    ];

    /**
     * Get the date attribute in Indonesian format.
     *
     * @param  string  $value
     * @return string
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)
            ->timezone(config('app.timezone'))
            ->translatedFormat('d F Y H:i');
    }

    /**
     * The timestamps are not used in this model.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the shipment that owns the log.
     */
    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    /**
     * Get the user that owns the log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
