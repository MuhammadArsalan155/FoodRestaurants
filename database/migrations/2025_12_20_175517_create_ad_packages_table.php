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
        Schema::create('ad_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('ad_type', ['banner', 'buzzintown', 'featured_listing', 'premium_badge', 'top_search']);
            $table->integer('duration_days');
            $table->decimal('price', 10, 2);
            $table->json('features')->nullable();
            $table->string('position', 100)->nullable()->comment('homepage, category, search');
            $table->integer('max_impressions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_packages');
    }
};
