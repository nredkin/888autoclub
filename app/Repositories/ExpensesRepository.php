<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ExpensesRepositoryInterface;


class ExpensesRepository implements ExpensesRepositoryInterface
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getAllThisDay($expenses)
    {
        return $expenses->where('created_at', '>=', Carbon::now()->startOfDay())->where('created_at', '<=', Carbon::now()->endOfDay());
    }
    public function getAllThisMonth($expenses)
    {
        return $expenses->where('created_at', '>=', Carbon::now()->startOfMonth())->where('created_at', '<=', Carbon::now()->endOfMonth());
    }

    public function getWithBranch_id($query, $branch_id)
    {
        return $query->where('branch_id', $branch_id);
    }

    public function getWithQuery($query)
    {
        if ($branch = $this->request->query('branch')) {
            $query = $query->where('branch_id', $branch);
        }

        if ($user = $this->request->query('user')) {
            $query = $query->where('user_id', $user);
        }

        if ($dateFrom = $this->request->get('dateFrom')) {
            $dateFrom = Carbon::parse($dateFrom)->startOfDay();
            $query = $query->where('created_at', '>=', $dateFrom);
        }

        if ($dateTo = $this->request->get('dateTo')) {
            $dateTo = Carbon::parse($dateTo)->endOfDay();
            $query = $query->where('created_at', '<=', $dateTo);
        }
        return $query;
    }

    public function check_filter_query(): bool
    {
        $queryParameters = $this->request->all();
        $valuesArray = array();

        foreach ($queryParameters as $key => $value) {
            $valuesArray[] = $value;
        }

        return empty(array_filter($valuesArray));
    }
}
