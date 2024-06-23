<?php

namespace App\Http\Controllers\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organizations\Users\CreateUserRequest;
use App\Http\Requests\Organizations\Users\UpdateUserRequest;
use Domains\Organizations\Contracts\UsersServiceInterface;
use Domains\Organizations\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected UsersServiceInterface $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    public function index(Request $request, string $organizationId)
    {
        $filters = $request->all();

        $users = $this->usersService->list($organizationId, $filters);

        return response()->json($users);
    }

    public function store(CreateUserRequest $request, string $organizationId)
    {
        $data = $request->validated();
        $user = $this->usersService->create($organizationId, $data);

        return response()->json($user, 201);
    }

    public function show(string $organizationId, string $userId)
    {
        $user = $this->usersService->get($userId);

        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, string $organizationId, string $userId)
    {
        $data = $request->validated();
        $this->usersService->update($organizationId, $userId, $data);

        return response()->json([
            'message' => 'User updated successfully',
        ]);
    }

    public function destroy(string $organizationId, string $userId)
    {
        $this->usersService->destroy($organizationId, $userId);

        return response()->json([
            'message' => 'User deleted successfully',
        ], 204);
    }
}
