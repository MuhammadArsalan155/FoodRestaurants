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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->foreignId('menu_category_id')->nullable()->constrained('menu_categories')->onDelete('set null');
            $table->string('item_name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discounted_price', 10, 2)->nullable();
            $table->string('portion_size', 100)->nullable();
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_spicy')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('restaurant_id');
            $table->index('menu_category_id');
            $table->index('is_popular');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
