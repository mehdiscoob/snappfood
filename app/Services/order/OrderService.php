<?php

namespace App\Services\order;

use App\Repositories\order\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $data)
    {
        $dateTime = new \DateTime($data->time);
        $dateTime->modify('+50 minutes');
        $data->time = $dateTime->format('Y-m-d H:i:s');
        return $this->orderRepository->create($data);
    }
}
