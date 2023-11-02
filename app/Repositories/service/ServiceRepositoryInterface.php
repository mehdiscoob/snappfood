<?php

namespace App\Repositories\service;

use App\Models\Service;

interface ServiceRepositoryInterface
{
    public function getAllServices();
    public function createService(array $data);
}
