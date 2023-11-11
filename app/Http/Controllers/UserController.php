<?php


namespace App\Http\Controllers;

use App\Services\user\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Find a user randomly based on the specified role.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function findByRandomly(Request $request): JsonResponse
    {
        $user = $this->userService->findRandomly($request->role);

        if ($user) {
            return response()->json($user, 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    /**
     * Find a user by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function findById(int $id): JsonResponse
    {
        $user = $this->userService->findById($id);

        if ($user) {
            return response()->json($user, 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }
}
