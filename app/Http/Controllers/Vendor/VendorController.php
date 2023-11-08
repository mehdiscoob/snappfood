<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Services\vendor\VendorService;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    private $vendorService;

    /**
     * @param $vendorService
     */
    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    public function findRandomly()
    {
        return $this->vendorService->findRandomly();
    }


}
