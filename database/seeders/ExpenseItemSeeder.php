<?php
namespace Database\Seeders;

use App\Models\ExpenseItem;
use Illuminate\Database\Seeder;

class ExpenseItemSeeder extends Seeder
{
    public function run()
    {
        $expenseItems = [
            'Аренда',
            'Выкуп',
            'Ремонт',
        ];

        foreach ($expenseItems as $expenseItem) {
            ExpenseItem::create(['name' => $expenseItem]);
        }
    }
}
