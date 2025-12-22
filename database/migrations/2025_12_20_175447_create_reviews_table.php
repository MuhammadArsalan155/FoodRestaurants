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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('google_email')->nullable();

            $table->decimal('rating', 2, 1);
            $table->decimal('food_rating', 2, 1)->nullable();
            $table->decimal('service_rating', 2, 1)->nullable();
            $table->decimal('ambiance_rating', 2, 1)->nullable();
            $table->decimal('value_rating', 2, 1)->nullable();

            $table->text('review');
            $table->text('pros')->nullable()->comment('What they liked');
            $table->text('cons')->nullable()->comment('What could be better');

            $table->json('images')->nullable();

            $table->enum('visit_type', ['dine_in', 'takeaway', 'delivery', 'not_specified'])->default('not_specified');
            $table->date('visit_date')->nullable();

            $table->boolean('is_verified')->default(false);
            $table->boolean('verified_purchase')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected', 'flagged'])->default('pending');
            $table->boolean('is_featured')->default(false);

            $table->integer('helpful_count')->default(0);
            $table->integer('not_helpful_count')->default(0);

            $table->text('restaurant_reply')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->foreignId('replied_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('restaurant_id');
            $table->index('rating');
            $table->index('status');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
