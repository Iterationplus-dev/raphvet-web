<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('position_applied');
            $table->enum('experience_years', ['0-1', '1-3', '3-5', '5-10', '10+']);
            $table->text('cover_letter');
            $table->string('cv_path')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->enum('status', ['new', 'reviewed', 'shortlisted', 'rejected'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
