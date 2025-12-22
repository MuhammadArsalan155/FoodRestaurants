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
        Schema::create('user_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')->onDelete('set null');
            $table->foreignId('deal_id')->nullable()->constrained('deals')->onDelete('set null');
            $table->enum('action_type', ['view', 'call', 'whatsapp', 'direction', 'share', 'menu_view', 'deal_view', 'photo_view']);
            $table->string('source_page', 100)->nullable();
            $table->enum('device_type', ['desktop', 'mobile', 'tablet'])->nullable();
            $table->string('session_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->nullable();

            $table->index('user_id');
            $table->index('restaurant_id');
            $table->index('action_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_interactions');
    }
};
