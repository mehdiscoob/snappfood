<?php

namespace App\Http\Controllers\Trip;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trip\CreateTripRequest;
use App\Services\trip\TripService;
use Illuminate\Http\Request;

class TripController extends Controller
{

    private $tripService;

    /**
     * @param $tripService
     */
    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }


    public function createTrip(CreateTripRequest $request)
    {
        return $this->tripService->create($request->all());
    }
}
