<?php

namespace App\Services\user;

use App\Events\EmailEvent;
use App\Mail\VerificationCodeEmail;
use App\Models\User;
use App\Repositories\user\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById($userId)
    {
        return $this->userRepository->findById($userId);
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    public function getUserByMobile($mobile)
    {
        return $this->userRepository->findByMobile($mobile);
    }

    public function updateUser(array $userData, $userId)
    {
        return $this->userRepository->update($userData, $userId);
    }

    public function deleteUser($userId)
    {
        return $this->userRepository->delete($userId);
    }
}
