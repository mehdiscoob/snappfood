<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Http\Requests\user\CreateUserRequest;
use App\Services\user\UserService;
use Illuminate\Http\Request;
use App\models\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(CreateUserRequest $request)
    {
        $registered = $this->userService->register($request->all());
        if ($registered) {
            return response()->json($registered, 201);
        } else {
            return response()->json(['message' => 'User registration failed'], 500);
        }
    }

    public function getUserById($id)
    {

        return $this->userService->getUserById($id);
   }

    public function verifyAccount(Request $request)
    {

        $user= $this->userService->verifyAccount($request->code);
        if ($user) {
            return response()->json([$user]);
        } else {
            return response()->json(['message' => 'User verification failed'], 500);
        }
    }


}
