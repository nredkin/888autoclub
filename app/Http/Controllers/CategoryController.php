<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(private Category $categories)
    {
    }

    public function list()
    {;
        $categories = $this->categories::all();
        return new JsonResponse(['categories' => CategoryResource::collection($categories)]);
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $category = $this->categories->newInstance();

        $category->name = $request->getName();

        $category->save();

        return new JsonResponse(['category' => CategoryResource::make($category)]);
    }

    public function show(int $id): JsonResponse
    {
        $category = $this->categories->find($id);

        if (!$category) {
            return $this->error('Филиал не найден');
        }

        return new JsonResponse(['category' => CategoryResource::make($category)]);
    }

    public function update(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $category = $this->categories->find($id);

        if (!$category) {
            return $this->error('Филиал не найден');
        }

        $category->name = $request->getName();

        $category->save();

        return new JsonResponse(['category' => CategoryResource::make($category)]);
    }

    public function delete(int $id): JsonResponse
    {
        $category = $this->categories->find($id);

        if (!$category) {
            return $this->error('Филиал не найден');
        }

        $category->delete();

        return $this->success();
    }

    public function dict(): JsonResponse
    {
        $result = [];
        foreach ($this->categories::all() as $category) {
            $result[] = [
                'id'   => $category->id,
                'name' => $category->name,
            ];
        }
        return new JsonResponse(['categories' => $result]);
    }
}
