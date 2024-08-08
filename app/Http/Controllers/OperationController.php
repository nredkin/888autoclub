<?php

namespace App\Http\Controllers;

use App\Http\Requests\Operation\CreateOperationRequest;
use App\Http\Resources\OperationResource;
use App\Models\Car;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OperationController extends Controller
{
    public function __construct(private Operation $operations)
    {

    }
    public function list(Request $request)
    {
        $query = $request->get('query');

        // Start building the query with relationships
        $operationsQuery = Operation::with('user.userable', 'car');

        // Apply filters if they exist
        if ($query && isset($query['filters'])) {
            $filters = $query['filters'];
            logger($filters);

            // Filter by branch_id if 'branches' filter is present
            if (isset($filters['branches'])) {
                $operationsQuery->whereIn('branch_id', $filters['branches']);
            }

            // Additional filters can be added here
            if (isset($filters['cars'])) {
                $operationsQuery->whereIn('car_id', $filters['cars']);
            }

            if (isset($filters['users'])) {
                $operationsQuery->whereIn('user_id', $filters['users']);
            }

            if (isset($filters['date_from'])) {
                $operationsQuery->where('date', '>=', $filters['date_from']);
            }

            if (isset($filters['date_to'])) {
                $operationsQuery->where('date', '<=', $filters['date_to']);
            }

            if (isset($filters['type'])) {
                $operationsQuery->where('type', '=', $filters['type']);
            }

            if (isset($filters['client_balance_change'])) {
                $operationsQuery->where('client_balance_change', '=', $filters['client_balance_change']);
            }
        }

        // Execute the query
        $operations = $operationsQuery->get();

        // Return the response with the filtered operations
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
        $operation->car_id = $request->getCarId();
        $operation->deal_id = $request->getDealId();
        $operation->branch_id = $request->getBranchId();
        $operation->expense_item_id = $request->getExpenseItemId();
        $operation->sum = $request->getSum();
        $operation->type = $request->getType();
        $operation->client_balance_change = $request->getClientBalanceChange();

        $operation->save();

        if ($operation->client_balance_change == 1) {
            $user = User::with('userable')->find($operation->user_id);
            if ($user->userable_type == Client::class) {
                $client = Client::find($user->userable->id);
                $newBalance = $client->balance;
                if ($operation->type == Operation::TYPE_POSITIVE ) {
                    $newBalance += $operation->sum;
                    $newBalance -= $operation->sum;
                }
                $client->update([
                    'balance' => $newBalance
                ]);
            }
        }

        return new JsonResponse(['operation' => OperationResource::make($operation)]);
    }

    public function delete(int $id): JsonResponse
    {
        $operation = $this->operations->find($id);

        if (!$operation) {
            return $this->error('Операция не найдена');
        }

        $operation->delete();

        return $this->success();
    }

    protected function getModelInstance($modelType, $modelId)
    {
        switch ($modelType) {
            case 'user':
                return User::with('operations')->findOrFail($modelId);
            case 'car':
                return Car::with('operations')->findOrFail($modelId);
            case 'deal':
                return Deal::with('operations')->findOrFail($modelId);
            default:
                throw new \Exception("Invalid model type");
        }
    }
}
