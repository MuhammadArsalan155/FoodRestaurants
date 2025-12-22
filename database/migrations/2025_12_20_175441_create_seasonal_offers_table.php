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
        Schema::create('seasonal_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->string('offer_title');
            $table->enum('season_type', ['ramadan', 'eid', 'christmas', 'new_year', 'valentine', 'independence_day', 'other']);
            $table->year('year');
            $table->text('description')->nullable();
            $table->string('banner_image')->nullable();
            $table->json('special_menu')->nullable()->comment('Special items for this season');
            $table->string('discount_text')->nullable()->comment('e.g., "Up to 30% OFF"');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_active')->default(true);
            $table->integer('view_count')->default(0);
            $table->timestamps();

            $table->index('restaurant_id');
            $table->index('season_type');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasonal_offers');
    }
};
