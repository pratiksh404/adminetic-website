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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->text('excerpt');
            $table->longText('description')->nullable();
            $table->json('videos')->nullable();
            $table->string('audio')->nullable();
            $table->bigInteger('position')->default(1);
            $table->boolean('active')->default(1);
            $table->boolean('featured')->default(0);
            $table->integer('status')->default(1);
            $table->integer('type')->default(1);
            // SEO Part
            $table->string('meta_name')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();

            // Foreign
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
