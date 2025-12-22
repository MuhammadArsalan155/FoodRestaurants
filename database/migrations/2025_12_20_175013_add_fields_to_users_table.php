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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->unique()->after('email');
            $table->timestamp('phone_verified_at')->nullable()->after('email_verified_at');
            $table->string('profile_image')->nullable()->after('password');
            $table->enum('user_type', ['customer', 'restaurant_owner', 'admin', 'moderator'])->default('customer')->after('profile_image');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('user_type');
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->string('last_login_ip', 45)->nullable()->after('last_login_at');

            $table->index('user_type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['user_type']);
            $table->dropIndex(['status']);
            $table->dropColumn([
                'phone',
                'phone_verified_at',
                'profile_image',
                'user_type',
                'status',
                'last_login_at',
                'last_login_ip'
            ]);
        });
    }
};
