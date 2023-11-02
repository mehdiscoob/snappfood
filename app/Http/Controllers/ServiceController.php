<?php

// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use App\Http\Requests\Service\CreateServiceRequest;
use App\Services\service\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        $services = $this->serviceService->getAllServices();
        return response()->json($services);
    }

    public function store(CreateServiceRequest $request)
    {
        $service = $this->serviceService->createService($request->all());
        return response()->json($service, 201);
    }

}
