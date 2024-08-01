<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseItem\CreateExpenseItemRequest;
use App\Http\Requests\ExpenseItem\UpdateExpenseItemRequest;
use App\Http\Resources\ExpenseItemResource;
use App\Models\ExpenseItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpenseItemController extends Controller
{
    public function __construct(private ExpenseItem $expenseItems)
    {

    }
    public function list()
    {
        $expenseItems = $this->expenseItems::all();
        return new JsonResponse(['expenseItems' => ExpenseItemResource::collection($expenseItems)]);
    }

    public function store(CreateExpenseItemRequest $request): JsonResponse
    {
        $expenseItem = $this->expenseItems->newInstance();

        $expenseItem->name = $request->getName();

        $expenseItem->save();

        return new JsonResponse(['expenseItem' => ExpenseItemResource::make($expenseItem)]);
    }

    public function show(int $id): JsonResponse
    {
        $expenseItem = $this->expenseItems->find($id);

        if (!$expenseItem) {
            return $this->error('Статья расходов не найдена');
        }

        return new JsonResponse(['expenseItem' => ExpenseItemResource::make($expenseItem)]);
    }

    public function update(UpdateExpenseItemRequest $request, int $id): JsonResponse
    {
        $expenseItem = $this->expenseItems->find($id);

        if (!$expenseItem) {
            return $this->error('Статья расходов не найдена');
        }

        $expenseItem->name = $request->getName();

        $expenseItem->save();

        return new JsonResponse(['expenseItem' => ExpenseItemResource::make($expenseItem)]);
    }

    public function delete(int $id): JsonResponse
    {
        $expenseItem = $this->expenseItems->find($id);

        if (!$expenseItem) {
            return $this->error('Статья расходов не найдена');
        }

        $expenseItem->delete();

        return $this->success();
    }
}
