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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('restaurant_name');
            $table->string('slug')->unique();
            $table->string('tagline', 500)->nullable()->comment('Short catchy tagline');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('banner_image')->nullable()->comment('For promotional banners');

            // Contact Information
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('website')->nullable();
            $table->string('contact')->nullable()->comment('Legacy field');
            $table->string('cellno')->nullable()->comment('Legacy field');

            // Location
            $table->string('location')->comment('Full address text');
            $table->string('area', 100);
            $table->string('city', 100)->default('Peshawar');
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('google_maps_url', 500)->nullable();
            $table->text('embed_map')->nullable()->comment('Iframe embed code');

            // Business Information
            $table->year('established_year')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('license_number', 100)->nullable();

            // Service Options
            $table->boolean('dine_in')->default(true);
            $table->boolean('takeaway')->default(true);
            $table->boolean('home_delivery')->default(true);
            $table->boolean('reservation_available')->default(false);
            $table->boolean('catering_available')->default(false);

            // Dining Options
            $table->boolean('breakfast')->default(true);
            $table->boolean('lunch')->default(true);
            $table->boolean('dinner')->default(true);
            $table->boolean('hitea')->default(false);
            $table->boolean('lunch_buffet')->default(false);
            $table->boolean('dinner_buffet')->default(false);
            $table->boolean('brunch_menu')->default(false);
            $table->boolean('alacarte')->default(true);

            // Operational Hours
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->boolean('is_24_hours')->default(false);
            $table->json('operating_days')->nullable()->comment('Days when restaurant is open');

            // Service-specific timings
            $table->time('breakfast_start_time')->nullable();
            $table->time('breakfast_end_time')->nullable();
            $table->time('lunch_start_time')->nullable();
            $table->time('lunch_end_time')->nullable();
            $table->time('dinner_start_time')->nullable();
            $table->time('dinner_end_time')->nullable();
            $table->time('hitea_start_time')->nullable();
            $table->time('hitea_end_time')->nullable();
            $table->time('lunch_buffet_start_time')->nullable();
            $table->time('lunch_buffet_end_time')->nullable();
            $table->time('dinner_buffet_start_time')->nullable();
            $table->time('dinner_buffet_end_time')->nullable();
            $table->text('timing_notes')->nullable();

            // Pricing Information
            $table->enum('price_range', ['budget', 'affordable', 'moderate', 'expensive', 'premium'])->default('affordable');
            $table->decimal('average_cost_per_person', 10, 2)->nullable();
            $table->decimal('average_buffet_price', 10, 2)->nullable();
            $table->decimal('average_deal_price', 10, 2)->nullable();

            // Amenities & Features
            $table->boolean('parking_available')->default(false);
            $table->string('parking_details', 500)->nullable();
            $table->boolean('wheelchair_accessible')->default(false);
            $table->boolean('wifi_available')->default(false);
            $table->string('wifi_password', 100)->nullable()->comment('Optional - some restaurants share this');
            $table->boolean('outdoor_seating')->default(false);
            $table->boolean('indoor_seating')->default(true);
            $table->boolean('private_dining')->default(false);
            $table->boolean('family_section')->default(false);
            $table->boolean('smoking_area')->default(false);
            $table->boolean('kids_play_area')->default(false);
            $table->boolean('pet_friendly')->default(false);
            $table->boolean('live_music')->default(false);
            $table->boolean('live_sports_screening')->default(false);
            $table->boolean('air_conditioned')->default(true);

            // Certifications & Special Features
            $table->boolean('halal_certified')->default(false);
            $table->boolean('hygienic_certified')->default(false);
            $table->json('awards')->nullable()->comment('List of awards/recognitions');
            $table->json('specialties')->nullable()->comment('Special dishes or features');

            // Payment Options
            $table->boolean('accepts_cash')->default(true);
            $table->boolean('accepts_cards')->default(true);
            $table->boolean('accepts_mobile_payments')->default(false);
            $table->json('payment_methods')->nullable()->comment('JazzCash, EasyPaisa, etc.');

            // Ratings & Statistics
            $table->decimal('rating_average', 3, 2)->default(0.00);
            $table->integer('rating_count')->default(0);
            $table->decimal('food_rating', 3, 2)->default(0.00);
            $table->decimal('service_rating', 3, 2)->default(0.00);
            $table->decimal('ambiance_rating', 3, 2)->default(0.00);
            $table->decimal('value_rating', 3, 2)->default(0.00);
            $table->integer('view_count')->default(0);
            $table->integer('favorite_count')->default(0);
            $table->integer('share_count')->default(0);
            $table->integer('call_count')->default(0);
            $table->integer('direction_count')->default(0);

            // Verification & Status
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->dateTime('featured_until')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->dateTime('premium_until')->nullable();
            $table->boolean('is_trending')->default(false);
            $table->enum('status', ['active', 'inactive', 'pending_approval', 'suspended', 'closed_permanently'])->default('pending_approval');
            $table->boolean('publish')->default(true);

            // Temporary Closure
            $table->boolean('temporarily_closed')->default(false);
            $table->string('closure_reason', 500)->nullable();
            $table->date('reopening_date')->nullable();

            // SEO & Marketing
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keywords', 500)->nullable();
            $table->string('og_image')->nullable()->comment('Open Graph image for social sharing');

            // Social Media
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();

            // Additional Info
            $table->text('admin_notes')->nullable();
            $table->integer('count')->default(0)->comment('Legacy view count');
            $table->integer('isfeature')->default(0)->comment('Legacy featured flag');

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('user_id');
            $table->index(['area', 'city']);
            $table->index('status');
            $table->index('is_featured');
            $table->index('is_premium');
            $table->index('is_trending');
            $table->index('rating_average');
            $table->index('price_range');
            $table->index(['latitude', 'longitude']);

            // Full-text search
            $table->fullText(['restaurant_name', 'description', 'tagline', 'area', 'city'], 'restaurants_search_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
