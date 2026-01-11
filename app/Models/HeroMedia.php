<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class HeroMedia extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'event_id',
        'uuid',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

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
