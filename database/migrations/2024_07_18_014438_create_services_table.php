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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('unit')->nullable();
            $table->boolean('with_driver')->default(false);
            $table->boolean('uniform_cost_for_cards')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('available_from_hours')->nullable();
            $table->integer('available_to_hours')->nullable();
            $table->string('invoice_name')->nullable();
            $table->boolean('is_collect')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
