<?php

use App\Models\Branch;
use App\Models\Car;
use App\Models\Client;
use App\Models\Deal;
use App\Models\ExpenseItem;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now());
            $table->foreignIdFor(Branch::class)->nullable();
            $table->foreignIdFor(Car::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(Deal::class)->nullable();
            $table->foreignIdFor(ExpenseItem::class)->nullable();
            $table->decimal('sum', 10, 2)->default(0);
            $table->tinyInteger('type')->default(0);
            $table->boolean('client_balance_change')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
