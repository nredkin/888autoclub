<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Deal;
use App\Models\Service;
use App\Services\ServiceService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    protected $serviceService;
    public function __construct(private Service $services, ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function list()
    {
        $services = $this->services::all();
        return new JsonResponse(['services' => ServiceResource::collection($services)]);
    }

    public function listByDealId($dealId)
    {
        $deal = Deal::with(['user.userable.clubCards.level'])->findOrFail($dealId);

        $carId = $deal->car_id;
        $clubCardLevelId = optional($deal->user->userable->clubCards->first())->club_card_level_id;

        $services = Service::with(['servicePrices' => function ($query) use ($carId, $clubCardLevelId) {
            $query->where(function ($query) use ($carId) {
                $query->where('car_id', $carId)
                    ->orWhereNull('car_id');
            })->where(function ($query) use ($clubCardLevelId) {
                $query->where('club_card_level_id', $clubCardLevelId)
                    ->orWhereNull('club_card_level_id');
            });
        }])
            ->whereHas('deals', function ($query) use ($dealId) {
                $query->where('deal_id', $dealId);
            })
            ->get();

        // Retrieve pivot table data explicitly
        $dealServices = DB::table('deal_service')
            ->where('deal_id', $dealId)
            ->get();

        foreach ($services as $service) {
            $pivotData = $dealServices->firstWhere('service_id', $service->id);

            if ($pivotData) {
                $service->custom_price = $pivotData->price ?? ($service->servicePrices->first()->price ?? null);
                $rentalStart = $pivotData->rental_start ?? $deal->rental_start;
                $rentalEnd = $pivotData->rental_end ?? $deal->rental_end;

                $days = $this->serviceService->calculateDaysBetween($pivotData->rental_start, $pivotData->rental_end);
                $service->price_total = $service->custom_price * $days;
            } else {
                // Set defaults if no pivot data
                $service->custom_price = $service->servicePrices->first()->price ?? null;
                $rentalStart = $deal->rental_start;
                $rentalEnd = $deal->rental_end;
            }
            // Calculate the number of days and set total price
            $days = ($rentalStart && $rentalEnd)
                ? $this->serviceService->calculateDaysBetween($rentalStart, $rentalEnd)
                : 1;
            $service->price_total = $service->custom_price * $days;
            $service->rental_start = $rentalStart;
            $service->rental_end = $rentalEnd;
        }

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
