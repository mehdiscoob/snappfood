<?php

namespace App\Repositories\user;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function findById($userId)
    {
        return User::find($userId);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function findByMobile($mobile)
    {
        return User::where('mobile', $mobile)->first();
    }

    public function update(array $data, $userId)
    {
        $user = $this->findById($userId);

        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    public function delete($userId)
    {
        $user = $this->findById($userId);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
