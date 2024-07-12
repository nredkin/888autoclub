<?php

namespace App\Repositories\Interfaces;

interface ExpensesRepositoryInterface
{
    public function getWithBranch_id($query, $branch_id);

    public function getAllThisDay($expenses);

    public function getAllThisMonth($expenses);

    public function getWithQuery($query);

    public function check_filter_query(): bool;
}
