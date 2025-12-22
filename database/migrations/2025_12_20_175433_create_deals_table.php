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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->string('deal_title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->text('terms_conditions')->nullable();

            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('deal_price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->decimal('savings_amount', 10, 2)->nullable();

            $table->enum('deal_type', ['daily', 'weekend', 'ramadan', 'eid', 'christmas', 'valentine', 'birthday', 'corporate', 'seasonal', 'other'])->default('daily');
            $table->integer('serves')->nullable()->comment('Number of people');
            $table->json('includes')->nullable()->comment('Items included in deal');

            $table->dateTime('valid_from');
            $table->dateTime('valid_until');
            $table->json('available_days')->nullable()->comment('Days when deal is valid');
            $table->time('available_time_from')->nullable();
            $table->time('available_time_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_exclusive')->default(false);

            $table->integer('max_redemptions')->nullable()->comment('Total times deal can be used');
            $table->integer('redemption_count')->default(0);
            $table->integer('per_person_limit')->nullable();

            $table->integer('view_count')->default(0);
            $table->integer('interest_count')->default(0);
            $table->integer('share_count')->default(0);

            $table->string('badge_text', 50)->nullable()->comment('e.g., "HOT DEAL", "LIMITED TIME"');
            $table->string('highlight_color', 20)->nullable();
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            $table->index('restaurant_id');
            $table->index('deal_type');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index(['valid_from', 'valid_until']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
