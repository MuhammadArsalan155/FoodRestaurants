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
        Schema::create('search_queries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('search_term');
            $table->enum('search_type', ['restaurant', 'category', 'food', 'location', 'deal']);
            $table->json('filters_applied')->nullable();
            $table->integer('results_count')->default(0);
            $table->boolean('result_clicked')->default(false);
            $table->foreignId('clicked_restaurant_id')->nullable()->constrained('restaurants')->onDelete('set null');
            $table->string('session_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->nullable();

            $table->index('user_id');
            $table->index('search_term');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_queries');
    }
};
