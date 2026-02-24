<?php

namespace App\Actions\Business;

use App\DTOs\RegisterBusinessDto;
use App\Exceptions\GeneralExceptionHandler;
use App\Http\Resources\UserResource;
use App\Models\AccountType;
use App\Models\BusinessType;
use Arr;

class CreateBusinessTypeAction
{
    public function execute()
    {
        $user = auth()->user();
        $accountType = AccountType::whereUuid(request('account_type_id'))->first();

        throw_if(
            blank($accountType),
            new GeneralExceptionHandler('Account type not found.', 404)
        );

        $this->validateBusinessData($accountType);

        $user->account_type_id = $accountType->id;
        $user->save();

        $this->handleBusinessType($user, $accountType);

        return response()->json([
            'status' => 200,
            'data' => new UserResource($user),
            'message' => 'Business type created successfully.',
        ]);

    }

    private function handleBusinessType($user, $accountType)
    {
        $data = request()->only([
            'business_type_id',
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
        ]);

        $businessType = BusinessType::whereUuid(Arr::get($data, 'business_type_id'))->first();

        throw_if(
            blank($businessType),
            new GeneralExceptionHandler('Business type not found.', 404)
        );

        Arr::set($data, 'business_type_id', $businessType->id);

        $data = RegisterBusinessDto::from($data);

        $newBusiness = (new RegisterNewBusiness())->execute($data);

        throw_if(
            blank($newBusiness),
            new GeneralExceptionHandler('Failed to create business.', 500)
        );
    }

    private function validateBusinessData($accountType)
    {
        $allowedAccountTypes = ['Business', 'Non-Profit'];

        if (in_array($accountType->name, $allowedAccountTypes)) {
            request()->validate([
                'business_type_id' => 'required|uuid',
                'business_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'business_category' => 'required|string|max:255',
                'business_type' => 'required|string|max:255',
                'business_email' => 'required|email|max:255',
                'business_facebook_url' => 'required|url|max:255',
                'business_twitter_url' => 'required|url|max:255',
                'business_instagram_url' => 'required|url|max:255',
                'business_whatsapp_number' => 'required|string|max:20',
                'business_contact' => 'required|string|max:255', 
                'tax_identification_number' => 'required|string|max:255',
                'business_description' => 'required|string',
            ]);
        }
    }
}