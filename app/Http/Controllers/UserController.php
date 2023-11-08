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

    public function findByRandomly(Request $request)
    {
        return $this->userService->findRandomly($request->role);
    }

    public function findById($id)
    {
        return $this->userService->findById($id);
    }


}
