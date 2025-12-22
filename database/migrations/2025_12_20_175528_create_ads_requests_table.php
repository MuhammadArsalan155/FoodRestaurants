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
        Schema::create('ads_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->constrained('ad_packages')->onDelete('set null');
            $table->enum('ad_type', ['banner', 'buzzintown', 'featured_listing', 'premium']);
            $table->integer('adtype')->comment('Legacy field');
            $table->string('package_name');
            $table->decimal('price', 10, 2);
            $table->integer('days');
            $table->string('file_name');
            $table->string('file_path', 500)->nullable();
            $table->string('buzzintownmenu')->nullable()->comment('BuzzInTown menu image');
            $table->string('url', 500)->nullable();

            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone', 20)->nullable();

            $table->enum('payment_method', ['cash', 'bank_transfer', 'online', 'jazzcash', 'easypaisa'])->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->string('transaction_id', 100)->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->enum('ad_status', ['pending', 'approved', 'active', 'completed', 'rejected', 'cancelled'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->dateTime('ad_date')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();

            $table->timestamps();

            $table->index('restaurant_id');
            $table->index('payment_status');
            $table->index('ad_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_requests');
    }
};
