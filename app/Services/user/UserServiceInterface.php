<?php

namespace App\Services\user;

interface UserServiceInterface
{
    public function getUserById($userId);
    public function getUserByEmail($email);
    public function getUserByMobile($mobile);
    public function updateUser(array $userData, $userId);
    public function deleteUser($userId);
}
