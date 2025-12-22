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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')->onDelete('cascade');
            $table->string('title');
            $table->string('file_name')->nullable();
            $table->string('file_path', 500)->nullable();
            $table->enum('ad_type', ['banner', 'popup', 'sidebar', 'sponsored'])->default('banner');
            $table->integer('adtype')->nullable()->comment('Legacy field');
            $table->string('position', 100)->nullable();
            $table->string('url', 500)->nullable();
            $table->boolean('target_blank')->default(true);

            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->decimal('ctr', 5, 2)->default(0.00)->comment('Click-through rate');

            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('daysfor')->nullable()->comment('Legacy field');

            $table->boolean('is_active')->default(true);
            $table->boolean('publish')->default(true);

            $table->timestamps();

            $table->index('restaurant_id');
            $table->index('is_active');
            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
