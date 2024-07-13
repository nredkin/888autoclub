<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\ClubCardLevel;
use Illuminate\Http\JsonResponse;

class ClubCardLevelController extends Controller
{
    public function __construct(private ClubCardLevel $clubCardLevels)
    {
    }

    public function list()
    {;
        $clubCardLevels = $this->clubCardLevels::all();
        return new JsonResponse(['clubCardLevels' => CategoryResource::collection($clubCardLevels)]);
    }

    public function show(int $id): JsonResponse
    {
        $clubCardLevel = $this->clubCardLevels->find($id);

        if (!$clubCardLevel) {
            return $this->error('Филиал не найден');
        }

        return new JsonResponse(['category' => CategoryResource::make($clubCardLevel)]);
    }

    public function dict(): JsonResponse
    {
        $result = [];
        foreach ($this->clubCardLevels::all() as $clubCardLevel) {
            $result[] = [
                'id'   => $clubCardLevel->id,
                'name' => $clubCardLevel->name,
            ];
        }
        return new JsonResponse(['clubCardLevels' => $result]);
    }
}
