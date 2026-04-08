<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Make customer_id nullable to allow guest bookings
            $table->foreignId('customer_id')->nullable()->change();

            // Guest contact details (used when customer_id is null)
            $table->string('guest_name')->nullable()->after('customer_id');
            $table->string('guest_email')->nullable()->after('guest_name');
            $table->string('guest_phone', 20)->nullable()->after('guest_email');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['guest_name', 'guest_email', 'guest_phone']);
            $table->foreignId('customer_id')->nullable(false)->change();
        });
    }
};
