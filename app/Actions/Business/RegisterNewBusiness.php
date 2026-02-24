<?php

namespace App\Actions\Business;

use App\DTOs\RegisterBusinessDto;
use App\Models\Client;

class RegisterNewBusiness
{
    public function execute(RegisterBusinessDto $data)
    {

        // TODO: Use update or create to make sure that same business is not being stored twice. This will be based on the business email for now, but we can add more checks later.

        $businessRecord = new Client();

        $code = $this->generateUniqueCode();

        $businessRecord->business_name = $data->business_name;
        $businessRecord->address = $data->address;
        $businessRecord->country = $data->country;
        $businessRecord->city = $data->city;
        $businessRecord->business_category = $data->business_category;
        $businessRecord->business_type = $data->business_type;
        $businessRecord->business_email = $data->business_email;
        $businessRecord->business_facebook_url = $data->business_facebook_url;
        $businessRecord->business_twitter_url = $data->business_twitter_url;
        $businessRecord->business_instagram_url = $data->business_instagram_url;
        $businessRecord->business_whatsapp_number = $data->business_whatsapp_number;
        $businessRecord->business_contact = $data->business_contact;
        $businessRecord->tax_identification_number = $data->tax_identification_number;
        $businessRecord->business_description = $data->business_description;
        $businessRecord->business_type_id = $data->business_type_id;
        $businessRecord->business_code = $code;

        $businessRecord->save();

        $user = auth()->user();
        $user->client_id = $businessRecord->id;
        $user->save();

        return $businessRecord;
    }

    public function generateUniqueCode(): string
{
    $time = now()->format('YmdHisv');

    $hash = crc32($time);
    return str_pad(substr(abs($hash), 0, 6), 6, '0', STR_PAD_LEFT);
}
}