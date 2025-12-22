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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->string('video_url', 500);
            $table->enum('video_type', ['youtube', 'vimeo', 'facebook', 'instagram', 'tiktok', 'other'])->default('youtube');
            $table->string('video_id')->nullable()->comment('Platform-specific video ID');
            $table->string('thumbnail')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('duration')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('view_count')->default(0);
            $table->integer('sort_order')->default(0);
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->index('restaurant_id');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
