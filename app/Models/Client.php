<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'uuid',
        'business_name',
        'address',
        'country',
        'city',
        'business_category',
        'business_type',
        'business_email',
        'business_facebook_url',
        'business_twitter_url',
        'business_instagram_url',
        'business_whatsapp_number',
        'business_contact', 
        'tax_identification_number',
        'business_description',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'client_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id');
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
