<?php

namespace App\Http\Controllers;

use App\Actions\Business\CreateBusinessAction;
use App\Actions\Business\GetBusinessType;
use App\Actions\User\GetAccountType;
use App\Http\Requests\CreateAccountTypeRequest;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    public function getAccountTypes(GetAccountType $action)
    {
        return $action->execute();
    }

    public function getBusinessTypes(GetBusinessType $action)
    {
        return $action->execute();
    }

    public function createAccountType(CreateAccountTypeRequest $request, CreateBusinessAction $action)
    {
        return $action->execute();
    }
}
