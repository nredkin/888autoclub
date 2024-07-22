<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServicePriceResource;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Models\ServicePrice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServicePriceController extends Controller
{
    public function __construct(private ServicePrice $prices)
    {

    }
    public function index($serviceId)
    {
        $prices = $this->prices->where('service_id', $serviceId)->get();
        return new JsonResponse(['servicePrices' => ServicePriceResource::collection($prices)]);
    }

    public function getServicePricesByCar($carId)
    {
        // Get all services with their related prices for the specific car
        $services = Service::whereHas('servicePrices', function ($query) use ($carId) {
            $query->where('car_id', $carId);
        })->with(['servicePrices' => function ($query) use ($carId) {
            $query->where('car_id', $carId);
        }])->get();

        // Format the response
        $result = $services->map(function ($service) {
            return [
                'service' => new ServiceResource($service),
                'servicePrices' => ServicePriceResource::collection($service->servicePrices),
            ];
        });

        return new JsonResponse(['services' => $result]);
    }
}
