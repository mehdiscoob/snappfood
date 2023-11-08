<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Services\order\OrderService;

class OrderController extends Controller
{
    private $orderService;

    /**
     * OrderController constructor.
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Create a new order.
     *
     * @param CreateOrderRequest $request
     * @return mixed
     */
    public function createOrder(CreateOrderRequest $request)
    {
        return $this->orderService->create($request->all());
    }

    /**
     * Create a new order.
     *
     * @param CreateOrderRequest $request
     * @return mixed
     */
    public function findRandomly()
    {
        return $this->orderService->findRandomly();
    }
}
