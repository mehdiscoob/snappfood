<?php

namespace App\Services\trip;

use App\Repositories\trip\TripsRepositoryInterface;

class TripService
{
    protected $tripRepositorye;

    public function __construct(TripsRepositoryInterface $tripRepositorye)
    {
        $this->tripRepositorye=$tripRepositorye;
    }

}
