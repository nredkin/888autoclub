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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('phone_number', 32)->unique()->nullable();
            $table->decimal('balance')->default(0);
            $table->integer('bonus_points')->default(0);
            $table->date('birthday')->nullable();
            $table->string('passport_series')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_notes')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->string('inn')->nullable();
            $table->string('registration_address')->nullable();
            $table->text('complaints')->nullable();
            $table->date('last_check_fssp')->nullable();
            $table->date('last_check_enforcement')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
