<?php

namespace App\Http\Controllers;

use App\Http\Requests\Operation\CreateOperationRequest;
use App\Http\Resources\OperationResource;
use App\Models\Car;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Operation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class OperationController extends Controller
{
    public function __construct(private Operation $operations)
    {

    }
    public function list()
    {
        $operations = $this->operations::all();
        return new JsonResponse(['operations' => OperationResource::collection($operations)]);
    }

    public function listByModelId(string $modelType, int $modelId)
    {
        $model = $this->getModelInstance($modelType, $modelId);
        return new JsonResponse(['operations' => OperationResource::collection($model->operations)]);
    }

    public function store(CreateOperationRequest $request): JsonResponse
    {
        $operation = $this->operations->newInstance();

        $operation->user_id = $request->getUserId();
        $operation->sum = $request->getSum();
        $operation->client_balance_change = $request->getClientBalanceChange();

        $operation->save();

        if ($operation->client_balance_change == 1) {
            $user = User::with('userable')->find($operation->user_id);
            $client = Client::find($user->userable->id);
            $client->update([
                'balance' => $client->balance + $operation->sum
            ]);
        }

        return new JsonResponse(['operation' => OperationResource::make($operation)]);
    }

    protected function getModelInstance($modelType, $modelId)
    {
        switch ($modelType) {
            case 'user':
                return User::with('operations')->findOrFail($modelId);
            case 'car':
                return Car::with('operations')->findOrFail($modelId);
            default:
                throw new \Exception("Invalid model type");
        }
    }
}
