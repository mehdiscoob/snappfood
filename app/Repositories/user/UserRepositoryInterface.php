<?php

namespace App\Repositories\user;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findById($userId);
    public function findByEmail($email);
    public function findByMobile($mobile);
    /**
     * Find a user by Randomly.
     *
     * @return User|null
     */
    public function findRandomly($role): ?User;
    public function update(array $data, $userId);
    public function delete($userId);
}
