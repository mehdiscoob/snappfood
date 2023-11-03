<?php

namespace App\Services\vendor;

use App\Repositories\vendor\VendorRepositoryInterface;

class VendorService implements VendorServiceInterface
{
    protected $vendorRepository;

    public function __construct(VendorRepositoryInterface $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }


}
