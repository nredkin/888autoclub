<?php

namespace App\Http\Controllers;

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
}
