<?php

namespace App\Services\trip;

use App\Repositories\trip\TripRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TripService implements TripServiceInterface
{
    protected $tripRepository;

    /**
     * TripService constructor.
     *
     * @param TripRepositoryInterface $tripRepository
     */
    public function __construct(TripRepositoryInterface $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    /**
     * Create a new trip based on the provided data.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $auth=Auth::user();
        if ($auth->role!="driver") return response()->json(['message' => "You can't access to this address"],403);
        $data["user_id"]=$auth->id;
        $trip= $this->tripRepository->create($data);
        return response()->json(['message' => 'Delay report created successfully',"data"=>$trip], 201);


    }

    /**
     * Change the status of a trip with the specified ID.
     *
     * @param int $id
     * @param string $status
     * @return bool
     */
    public function changeStatus(int $id, string $status): bool
    {
        return $this->tripRepository->update($id, ['status' => $status]);
    }

    /**
     * Find a trip based on the provided order ID.
     *
     * @param int $order_id
     * @return mixed
     */
    public function findByOrder(int $order_id)
    {
        return $this->tripRepository->findByOrder($order_id);
    }
}
