<?php

namespace App\Services\service;

use App\Repositories\service\ServiceRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ServiceService implements ServiceServiceInterface
{
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getAllServices()
    {
        if (Auth::user()->hasRole('normal') && Auth::user()->verified==false){
        throw new AuthorizationException();
    }
        return $this->serviceRepository->getAllServices();
    }

    public function createService(array $data)
    {
        if (!Auth::user()->hasRole('admin')){
            throw new AuthorizationException();
        }
        $data['admin_id']=Auth::id();
        return $this->serviceRepository->createService($data);
    }
}
