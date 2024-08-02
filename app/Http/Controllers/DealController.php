<?php

namespace App\Http\Controllers;

use App\Http\Requests\Deal\CreateDealRequest;
use App\Http\Requests\Deal\UpdateDealRequest;
use App\Http\Resources\DealResource;
use App\Models\Deal;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function __construct(private Deal $deals)
    {
    }

    public function list(): JsonResponse
    {
        $deals = $this->deals::all();
        return new JsonResponse(['deals' => DealResource::collection($deals)]);
    }

    public function store(CreateDealRequest $request): JsonResponse
    {
        $deal = $this->deals->newInstance();

        $deal->deal_type = $request->getDealType();
        $deal->user_id = $request->getUserId();
        $deal->car_id = $request->getCarId();
        $deal->branch_id = $request->getBranchId();
        $deal->security_deposit = $request->getSecurityDeposit();
        $deal->contract_date = $request->getContractDate();
        $deal->rental_start = $request->getRentalStart();
        $deal->rental_end = $request->getRentalEnd();
        $deal->comment = $request->getComment();

        $deal->save();

        return new JsonResponse(['deal' => DealResource::make($deal)]);
    }

    public function show(int $id): JsonResponse
    {
        $deal = $this->deals->find($id);

        if (!$deal) {
            return $this->error('Сделка не найдена');
        }

        return new JsonResponse(['deal' => DealResource::make($deal)]);
    }

    public function update(UpdateDealRequest $request, int $id): JsonResponse
    {
        $deal = $this->deals->find($id);

        if (!$deal) {
            return $this->error('Сделка не найдена');
        }

        $deal->deal_type = $request->getDealType();
        $deal->user_id = $request->getUserId();
        $deal->car_id = $request->getCarId();
        $deal->branch_id = $request->getBranchId();
        $deal->security_deposit = $request->getSecurityDeposit();
        $deal->contract_date = $request->getContractDate();
        $deal->rental_start = $request->getRentalStart();
        $deal->rental_end = $request->getRentalEnd();
        $deal->comment = $request->getComment();

        $deal->save();

        return new JsonResponse(['deal' => DealResource::make($deal)]);
    }

    public function delete(int $id): JsonResponse
    {
        $deal = $this->deals->find($id);

        if (!$deal) {
            return $this->error('Сделка не найдена');
        }

        $deal->delete();

        return $this->success();
    }



    public function attachService(Request $request, $dealId, $serviceId)
    {
        $deal = Deal::findOrFail($dealId);
//        $serviceId = $request->input('service_id');
        $price = $request->input('price', null);
        $rentalStart = $request->input('rental_start', null);
        $rentalEnd = $request->input('rental_end', null);

        // Check if the service is already attached
        if ($deal->services()->where('service_id', $serviceId)->exists()) {
            return response()->json(['message' => 'Услуга уже добавлена.'], 400);
        }

        // Attach the service to the deal with additional data
        $deal->services()->attach($serviceId, [
            'price' => $price,
            'rental_start' => $rentalStart,
            'rental_end' => $rentalEnd,
        ]);

        return response()->json(['message' => 'Услуга добавлена успешно.']);
    }


    // Detach a service from a deal
    public function detachService($dealId, $serviceId)
    {
        $deal = Deal::findOrFail($dealId);

        // Detach the service from the deal
        $deal->services()->detach($serviceId);

        return response()->json([
            'message' => 'Service detached successfully',
            'services' => $deal->services,
        ], 200);
    }

}
