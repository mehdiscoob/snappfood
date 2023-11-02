<?php

// app/Repositories/ServiceRepository.php

namespace App\Repositories\service;

use App\Models\Service;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getAllServices()
    {
        return Service::all();
    }

    public function createService(array $data)
    {
        return Service::create($data);
    }
}
