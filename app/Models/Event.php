<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'organizer_id',
        'name',
        'description',
        'category',
        'venue_name',
        'venue_address',
        'start_datetime',
        'end_datetime',
        'duration',
        'status',
        'max_capacity',
        'expected_attendees',
        'sales_target',
        'early_bird_deadline',
        'refund_policy',
        'published_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'organizer_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'event_id');
    }

    public function heroMedia()
    {
        return $this->hasOne(HeroMedia::class, 'event_id');
    }

    public function bio()
    {
        return $this->hasOne(EventBio::class, 'event_id');
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class, 'event_id');
    }
}
