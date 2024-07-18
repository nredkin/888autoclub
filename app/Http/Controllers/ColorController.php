<?php

namespace App\Http\Controllers;

use App\Http\Requests\Color\CreateColorRequest;
use App\Http\Requests\Color\UpdateColorRequest;
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

    public function store(CreateColorRequest $request): JsonResponse
    {
        $color = $this->colors->newInstance();

        $color->name = $request->getName();

        $color->save();

        return new JsonResponse(['color' => ColorResource::make($color)]);
    }

    public function show(int $id): JsonResponse
    {
        $color = $this->colors->find($id);

        if (!$color) {
            return $this->error('Цвет не найден');
        }

        return new JsonResponse(['color' => ColorResource::make($color)]);
    }

    public function update(UpdateColorRequest $request, int $id): JsonResponse
    {
        $color = $this->colors->find($id);

        if (!$color) {
            return $this->error('Цвет не найден');
        }

        $color->name = $request->getName();

        $color->save();

        return new JsonResponse(['color' => ColorResource::make($color)]);
    }

    public function delete(int $id): JsonResponse
    {
        $color = $this->colors->find($id);

        if (!$color) {
            return $this->error('Цвет не найден');
        }

        $color->delete();

        return $this->success();
    }
}
