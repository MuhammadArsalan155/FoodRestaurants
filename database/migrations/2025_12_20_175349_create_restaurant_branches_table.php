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
        Schema::create('restaurant_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->string('branch_name');
            $table->string('location', 500);
            $table->string('area', 100);
            $table->string('city', 100);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('manager_name')->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->json('operating_days')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('parent_restaurant_id');
            $table->index(['area', 'city']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_branches');
    }
};
