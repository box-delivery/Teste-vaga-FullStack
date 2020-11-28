<?php

namespace App\Domain\Users\Controllers;

use App\Domain\Users\Requests\UserRequest;
use App\Domain\Users\Services\CreateUserService;
use App\Domain\Shared\Traits\ExecuteService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use ExecuteService;

    public function store(UserRequest $request, CreateUserService $service)
    {
        $user = $this->execute($service, $request->all());
        return response($user, 201);
    }
}
