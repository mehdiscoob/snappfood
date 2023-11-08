<?php

namespace App\Services\user;

use App\Models\User;

interface UserServiceInterface
{
    public function getUserById($userId);
    public function getUserByEmail($email);
    public function getUserByMobile($mobile);
    /**
     * Find a user by Randomly.
     *
     * @return User|null
     */
    public function findRandomly($role): ?User;
    public function findById($id): ?User;
    public function updateUser(array $userData, $userId);
    public function deleteUser($userId);
}
