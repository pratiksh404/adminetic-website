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
        Schema::create(config('website.table_prefix', 'website').'_'.'processes', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            // $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('active')->default(1);
            $table->boolean('featured')->default(0);
            $table->bigInteger('position')->default(1);
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->json('data')->nullable();

            // SEO Part
            $table->string('meta_name')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on(config('website.table_prefix', 'website').'_'.'categories')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
