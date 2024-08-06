<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServicePriceResource;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Models\ServicePrice;
use http\Client\Curl\User;
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

    public function storeByServiceAndCar(Request $request)
    {
        $data = $request->validate([
            'newService' => 'required|array',
            'newServicePrices' => 'required|array',
        ]);

        $serviceId = $data['newService']['service_id'];
        $carId = $data['newService']['car_id'];
        $newServicePrices = $data['newServicePrices'];

        foreach ($newServicePrices as $index => $price) {
            $clubCardLevelId = $index === 0 ? null : $index;

            $servicePrice = ServicePrice::updateOrCreate(
                [
                    'service_id' => $serviceId,
                    'car_id' => $carId,
                    'club_card_level_id' => $clubCardLevelId,
                ],
                [
                    'price' => $price,
                ]
            );
        }

        return response()->json(['message' => 'Service prices stored successfully.']);

    }

    public function deleteByServiceAndCar($carId, $serviceId)
    {
        $servicePrices = ServicePrice::where('car_id', $carId)
            ->where('service_id', $serviceId)
            ->get();

        foreach ($servicePrices as $servicePrice) {
            $servicePrice->delete();
        }

        return response()->json([
            'message' => 'Цены успешно удалены'
        ]);
    }
}
