<?php

namespace App\Services\trip;

use App\Repositories\trip\TripRepositoryInterface;

class TripService implements TripServiceInterface
{
    protected $tripRepository;

    public function __construct(TripRepositoryInterface $tripRepository)
    {
        $this->tripRepository=$tripRepository;
    }

    public function create(array $data)
    {
        return $this->tripRepository->create($data);
    }

    public function changeStatus(int $id,string $status)
    {
        return $this->tripRepository->update($id,['status'=>$status]);
    }

    public function findByOrder(int $order_id)
    {
        return $this->tripRepository->findByOrder($order_id);
    }

}
