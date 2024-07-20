<?php

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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('deal_type');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade'); //
            $table->foreignId('branch_id')->default(1);
            $table->decimal('security_deposit', 10, 2)->default(30000); // Security deposit with a default value of 30,000
            $table->date('contract_date')->default(now()); // Contract date default to current date
            $table->dateTime('rental_start')->nullable(); // Start date and time of rental
            $table->dateTime('rental_end')->nullable(); // End date and time of rental
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
