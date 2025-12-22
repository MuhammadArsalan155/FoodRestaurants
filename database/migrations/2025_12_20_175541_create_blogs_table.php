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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('blog_title');
            $table->string('title')->nullable()->comment('Alternative title field');
            $table->string('slug')->unique();
            $table->text('blog_description')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('blog_content')->nullable();
            $table->longText('content')->nullable()->comment('Alternative content field');
            $table->string('featured_image')->nullable();

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('blog_categories')->onDelete('set null');

            $table->json('tags')->nullable();

            $table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();

            $table->integer('view_count')->default(0);
            $table->integer('reading_time')->nullable()->comment('in minutes');
            $table->boolean('is_featured')->default(false);

            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keywords', 500)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('created_by');
            $table->index('category_id');
            $table->index('status');
            $table->index('published_at');
            $table->fullText(['blog_title', 'blog_description', 'blog_content']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
