<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class EventVenue extends Model
{
    protected $fillable = [
        'uuid',
        'event_id',
        'country',
        'city',
        'address',
        'gps',
        'google_maps_link',
        'floor_number',
        'room_number',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
