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

        $businessRecord->business_name = $data->businessName;
        $businessRecord->address = $data->businessAddress;
        $businessRecord->city = $data->businessCity;
        $businessRecord->business_email = $data->businessEmail;
        $businessRecord->activation_level = '1';
        $businessRecord->business_code = $code;

        $businessRecord->save();

        $data->user->client_id = $businessRecord->id;
        $data->user->save();

        return $businessRecord;
    }

    public function generateUniqueCode(): string
{
    $time = now()->format('YmdHisv');

    $hash = crc32($time);
    return str_pad(substr(abs($hash), 0, 6), 6, '0', STR_PAD_LEFT);
}
}