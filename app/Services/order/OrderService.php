<?php

namespace App\Services\order;

use App\Repositories\order\OrderRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderService implements OrderServiceInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * OrderService constructor.
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Create a new order with additional data.
     *
     * @param array $data The data for the new order.
     * @return array The created order data.
     */
    public function create(array $data)
    {
        $dateTime = new \DateTime(now());
        $dateTime->modify('+50 minutes');
        $data['delivery_time'] = $dateTime->format('Y-m-d H:i:s');
        $data['user_id']=Auth::id();
        $data['orderNumber']=Str::uuid();
        return $this->orderRepository->create($data);
    }


    public function findById(int $id)
    {
        return $this->orderRepository->find($id);
    }

    /**
     * Find an order by its ID.
     *
     * @param int $id The ID of the order.
     * @return array|null The order data, or null if not found.
     */
    public function hasTrips(int $id)
    {
        return $this->orderRepository->hasTrips($id);
    }

    /**
     * Check if an order has associated trips.
     *
     * @param int $id The ID of the order.
     * @return bool True if the order has trips, false otherwise.
     */
    public function update(int $id,array $data)
    {
        return $this->orderRepository->update($id,$data);
    }
}
