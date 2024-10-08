<?php

use App\Models\Branch;
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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('vin');
            $table->integer('year');
            $table->string('engine_model');
            $table->string('engine_power');
            $table->string('color');
            $table->decimal('cost', 15);
            $table->foreignIdFor(Branch::class);
            $table->string('registration_series');
            $table->string('registration_number');
            $table->string('pts_number');
            $table->date('pts_date');
            $table->string('reg_sign');
            $table->text('description');
            $table->unsignedBigInteger('act_file_id')->nullable();
            $table->foreign('act_file_id')->references('id')->on('files')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
