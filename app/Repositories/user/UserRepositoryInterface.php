<?php

namespace App\Repositories\user;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findById($userId);
    public function findByEmail($email);
    public function findByMobile($mobile);
    public function update(array $data, $userId);
    public function delete($userId);
}
