<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\JsonResponse;

class BranchController extends Controller
{
    public function __construct(private Branch $branches)
    {
    }

    public function list()
    {
        $branches = $this->branches::all();
        return new JsonResponse(['branches' => BranchResource::collection($branches)]);
    }

    public function store(CreateBranchRequest $request): JsonResponse
    {
        $branch = $this->branches->newInstance();

        $branch->name = $request->getName();
        $branch->address = $request->getAddress();
        $branch->wa_token = $request->getWaToken();

        $branch->save();

        return new JsonResponse(['branch' => BranchResource::make($branch)], 201);
    }

    public function show(int $id): JsonResponse
    {
        $branch = $this->branches->find($id);

        if (!$branch) {
            return $this->error('Филиал не найден');
        }

        return new JsonResponse(['branch' => BranchResource::make($branch)]);
    }

    public function update(UpdateBranchRequest $request, int $id): JsonResponse
    {
        $branch = $this->branches->find($id);

        if (!$branch) {
            return $this->error('Филиал не найден');
        }

        $branch->name = $request->getName();
        $branch->address = $request->getAddress();
        $branch->wa_token = $request->getWaToken();

        $branch->save();

        return new JsonResponse(['branch' => BranchResource::make($branch)]);
    }

    public function delete(int $id): JsonResponse
    {
        $branch = $this->branches->find($id);

        if (!$branch) {
            return response()->json(['error' => 'Филиал не найден'], 404);
        }

        $branch->delete();

        return response()->json(null, 204);
    }

    public function dict(): JsonResponse
    {
        $result = [];
        foreach ($this->branches::all() as $branch) {
            $result[] = [
                'id'   => $branch->id,
                'name' => $branch->name,
            ];
        }
        return new JsonResponse(['branches' => $result]);
    }
}
