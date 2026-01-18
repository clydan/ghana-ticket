<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'uuid',
        'event_id',
        'path',
    ];

    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
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
