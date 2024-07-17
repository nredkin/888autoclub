<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\CreateCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function __construct(private Car $cars)
    {

    }

    public function list()
    {
        $cars = $this->cars::all();
        return new JsonResponse(['cars' => CarResource::collection($cars)]);
    }

    public function show(int $id): JsonResponse
    {
        $car = $this->cars->find($id);

        if (!$car) {
            return $this->error('Автомобиль не найден');
        }logger($car);

        return new JsonResponse(['car' => CarResource::make($car)]);
    }

    public function store(CreateCarRequest $request): JsonResponse
    {
        $car = $this->cars->newInstance();

        $car->model = $request->getModel();
        $car->vin = $request->getVin();
        $car->year = $request->getYear();
        $car->engine_model = $request->getEngineModel();
        $car->engine_power = $request->getEnginePower();
        $car->color_id = $request->getColorId();
        $car->cost = $request->getCost();
        $car->branch_id = $request->getBranchId();
        $car->registration_series = $request->getRegistrationSeries();
        $car->registration_number = $request->getRegistrationNumber();
        $car->pts_number = $request->getPtsNumber();
        $car->pts_date = $request->getPtsDate();
        $car->reg_sign = $request->getRegSign();
        $car->description = $request->getDescription();

        $car->save();

        return new JsonResponse(['car' => CarResource::make($car)]);
    }

    public function update(UpdateCarRequest $request, int $id): JsonResponse
    {
        $car = $this->cars->find($id);

        if (!$car) {
            return $this->error('Автомобиль не найден');
        }

        $car->model = $request->getModel();
        $car->vin = $request->getVin();
        $car->year = $request->getYear();
        $car->engine_model = $request->getEngineModel();
        $car->engine_power = $request->getEnginePower();
        $car->color_id = $request->getColorId();
        $car->cost = $request->getCost();
        $car->branch_id = $request->getBranchId();
        $car->registration_series = $request->getRegistrationSeries();
        $car->registration_number = $request->getRegistrationNumber();
        $car->pts_number = $request->getPtsNumber();
        $car->pts_date = $request->getPtsDate();
        $car->reg_sign = $request->getRegSign();
        $car->description = $request->getDescription();

        $car->save();

        return new JsonResponse(['car' => CarResource::make($car)]);
    }

    public function delete(int $id): JsonResponse
    {
        $car = $this->cars->find($id);

        if (!$car) {
            return $this->error('Автомобиль не найден');
        }

        $car->delete();

        return $this->success();
    }
}
