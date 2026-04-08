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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('name', 100);
            $table->enum('species', ['dog', 'cat', 'bird', 'rabbit', 'cattle', 'goat', 'pig', 'poultry', 'other'])->default('dog');
            $table->string('breed', 100)->nullable();
            $table->enum('gender', ['male', 'female', 'unknown'])->default('unknown');
            $table->date('date_of_birth')->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('microchip_number', 50)->nullable();
            $table->string('profile_photo', 255)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
