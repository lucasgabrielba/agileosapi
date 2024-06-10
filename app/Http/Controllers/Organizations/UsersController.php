<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizations\Users\CreateUserRequest;
use App\Http\Requests\Organizations\Users\UpdateUserRequest;
use Domains\Organizations\Contracts\UsersServiceInterface;
use Domains\Organizations\Services\UsersService;

class UsersController extends Controller
{
    protected UsersServiceInterface $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index(string $organizationId)
    {
        $users = $this->usersService->list($organizationId);

        return response()->json($users);
    }

    public function store(CreateUserRequest $request, string $organizationId)
    {
        $data = $request->validated();
        $user = $this->usersService->create($data, $organizationId);

        return response()->json($user, 201);
    }

    public function show(string $userId)
    {
        $user = $this->usersService->getOne($userId);

        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, string $userId)
    {
        $data = $request->validated();
        $user = $this->usersService->update($userId, $data);

        return response()->json($user);
    }

    public function destroy(string $userId)
    {
        $this->usersService->destroy($userId);

        return response()->json(null, 204);
    }
}