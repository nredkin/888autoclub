<?php

namespace App\Http\Controllers;

use App\Http\Requests\Deal\CreateDealRequest;
use App\Http\Requests\Deal\UpdateDealRequest;
use App\Http\Resources\DealResource;
use App\Models\Deal;
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

}
