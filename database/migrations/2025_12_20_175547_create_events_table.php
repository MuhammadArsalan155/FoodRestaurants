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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->string('event_title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->enum('event_type', ['live_music', 'sports_screening', 'special_dinner', 'theme_night', 'festival', 'other']);
            $table->string('banner_image')->nullable();
            $table->dateTime('event_date');
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->string('recurrence_pattern', 100)->nullable()->comment('weekly, monthly, etc.');
            $table->decimal('entry_fee', 10, 2)->nullable();
            $table->boolean('requires_booking')->default(false);
            $table->string('booking_contact', 100)->nullable();
            $table->integer('max_attendees')->nullable();
            $table->integer('current_attendees')->default(0);
            $table->boolean('is_active')->default(true);
            $table->integer('view_count')->default(0);
            $table->timestamps();

            $table->index('restaurant_id');
            $table->index('event_date');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
