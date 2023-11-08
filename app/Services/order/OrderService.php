<?php

namespace App\Services\order;

use App\Models\Order;
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
     * Create a new order with the provided data.
     *
     * @param array $data The data for the new order.
     *
     * @return Order The created order instance.
     *
     * @throws \Exception If there is an error while creating the order.
     */
    public function create(array $data): Order
    {
        $dateTime = new \DateTime(now());
        $dateTime->modify('+50 minutes');
        $data['delivery_time'] = $dateTime->format('Y-m-d H:i:s');
        $data['user_id'] = Auth::id();
        $data['orderNumber'] = Str::uuid();

        return $this->orderRepository->create($data);
    }

    /**
     * Find an order by its ID.
     *
     * @param int $id The ID of the order to find.
     *
     * @return Order|null The found order instance or null if not found.
     */
    public function findById(int $id): ?Order
    {
        return $this->orderRepository->find($id);
    }

    /**
     * Find an order by Randomly.
     *
     * @return Order|null
     */
    public function findRandomly(): ?Order{
        return $this->orderRepository->findRandomly();
    }

    /**
     * Find an order by its ID.
     *
     * @param int $id The ID of the order.
     * @return \stdClass|null An object containing order ID, user ID, and associated trip ID if trips exist, or null otherwise.
     */
    public function hasTrips(int $id): \stdClass
    {
        return $this->orderRepository->hasTrips($id);
    }

    /**
     * Check if an order has associated trips.
     *
     * @param int $id The ID of the order.
     * @return bool True if the order has trips, false otherwise.
     */
    public function update(int $id,array $data): bool
    {
        return $this->orderRepository->update($id,$data);
    }
}
