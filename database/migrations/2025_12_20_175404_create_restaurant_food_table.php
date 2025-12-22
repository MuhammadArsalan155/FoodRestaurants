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
        Schema::create('restaurant_food', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable()->comment('Optional price for this item');
            $table->boolean('is_featured')->default(false);
            $table->timestamp('created_at')->nullable();

            $table->unique(['restaurant_id', 'food_id']);
            $table->index('restaurant_id');
            $table->index('food_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_food');
    }
};
