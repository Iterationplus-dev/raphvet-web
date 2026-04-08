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
        Schema::create('vet_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('specialization', 100);
            $table->string('license_number', 50)->nullable();
            $table->tinyInteger('years_experience')->default(0);
            $table->text('bio')->nullable();
            $table->decimal('consultation_fee', 10, 2)->default(0);
            $table->json('available_days')->nullable();
            $table->time('available_start_time')->nullable();
            $table->time('available_end_time')->nullable();
            $table->tinyInteger('max_appointments_per_day')->default(8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vet_profiles');
    }
};
