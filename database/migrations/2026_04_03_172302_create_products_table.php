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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('product_categories')
                ->nullOnDelete();
            $table->string('sku', 50)->unique();
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->longText('description');
            $table->string('short_description', 500)->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_at_price', 10, 2)->nullable();
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('low_stock_threshold')->default(5);
            $table->boolean('track_stock')->default(true);
            $table->decimal('weight_kg', 8, 3)->nullable();
            $table->enum('type', ['food', 'accessory', 'medication', 'supplement', 'other'])->default('food');
            $table->boolean('requires_prescription')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->string('meta_title', 60)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['is_active', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
