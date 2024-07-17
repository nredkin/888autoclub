<?php

namespace App\Http\Controllers;

use App\Http\Resources\ColorResource;
use App\Models\Color;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function __construct(private Color $colors)
    {

    }
    public function list()
    {
        $cars = $this->colors::all();
        return new JsonResponse(['colors' => ColorResource::collection($cars)]);
    }
}
