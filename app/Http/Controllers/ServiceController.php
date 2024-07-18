<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private Service $services)
    {

    }

    public function list()
    {
        $services = $this->services::all();
        return new JsonResponse(['services' => ServiceResource::collection($services)]);
    }


    public function store(CreateServiceRequest $request): JsonResponse
    {
        $service = $this->services->newInstance();

        $service->name = $request->getName();
        $service->photo = $request->getPhoto(); // Assuming you store the uploaded file path or ID
        $service->unit = $request->getUnit();
        $service->with_driver = $request->getWithDriver();
        $service->uniform_cost_for_cards = $request->getUniformCostForCards();
        $service->is_active = $request->getIsActive();
        $service->available_from_hours = $request->getAvailableFromHours();
        $service->available_to_hours = $request->getAvailableToHours();
        $service->invoice_name = $request->getInvoiceName();
        $service->is_collect = $request->getIsCollect();


        $service->save();

        return new JsonResponse(['service' => ServiceResource::make($service)]);
    }

    public function show(int $id): JsonResponse
    {
        $service = $this->services->find($id);

        if (!$service) {
            return $this->error('Услуга не найдена');
        }

        return new JsonResponse(['service' => ServiceResource::make($service)]);
    }

    public function update(UpdateServiceRequest $request, int $id): JsonResponse
    {
        $service = $this->services->find($id);

        if (!$service) {
            return $this->error('Услуга не найдена');
        }

        $service->name = $request->getName();
        $service->photo = $request->getPhoto(); // Assuming you store the uploaded file path or ID
        $service->unit = $request->getUnit();
        $service->with_driver = $request->getWithDriver();
        $service->uniform_cost_for_cards = $request->getUniformCostForCards();
        $service->is_active = $request->getIsActive();
        $service->available_from_hours = $request->getAvailableFromHours();
        $service->available_to_hours = $request->getAvailableToHours();
        $service->invoice_name = $request->getInvoiceName();
        $service->is_collect = $request->getIsCollect();

        $service->save();

        return new JsonResponse(['service' => ServiceResource::make($service)]);
    }

    public function delete(int $id): JsonResponse
    {
        $service = $this->services->find($id);

        if (!$service) {
            return $this->error('Услуга не найдена');
        }

        $service->delete();

        return $this->success();
    }


}
