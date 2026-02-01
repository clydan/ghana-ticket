<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }

            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->name);
            }
        });
    }

    private static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
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

    public function venue()
    {
        return $this->hasOne(EventVenue::class, 'event_id');
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'event_id');
    }
}
