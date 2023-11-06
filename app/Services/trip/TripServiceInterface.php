<?php

namespace App\Services\trip;

interface TripServiceInterface
{

    public function create(array $data);

    public function changeStatus(int $id,string $status);

    public function findByOrder(int $order_id);
}
