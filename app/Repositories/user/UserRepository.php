<?php

namespace App\Repositories\user;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Find a user by their ID.
     *
     * @param int $userId
     * @return User|null
     */
    public function findById(int $userId): ?User
    {
        return User::find($userId);
    }

    /**
     * Find a user randomly based on their role.
     *
     * @param string|null $role
     * @return User|null
     */
    public function findRandomly(?string $role): ?User
    {
        return User::where('role', $role??"customer")->inRandomOrder()->first();
    }

    /**
     * Find a user by their email address.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Find a user by their mobile number.
     *
     * @param string $mobile
     * @return User|null
     */
    public function findByMobile(string $mobile): ?User
    {
        return User::where('mobile', $mobile)->first();
    }

    /**
     * Update a user's information.
     *
     * @param array $data
     * @param int $userId
     * @return User|null
     */
    public function update(array $data, int $userId): ?User
    {
        $user = $this->findById($userId);

        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    /**
     * Delete a user by their ID.
     *
     * @param int $userId
     * @return bool
     */
    public function delete(int $userId): bool
    {
        $user = $this->findById($userId);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
