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
        Schema::create(config('website.table_prefix', 'website') . '_' . 'products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->bigInteger('selling_price')->default(0);
            $table->bigInteger('cost_price')->nullable();
            $table->bigInteger('quantity')->default(1);
            $table->bigInteger('quantity_alert')->default(1);
            $table->bigInteger('points')->default(0);
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('position')->default(1);
            $table->boolean('active')->default(1);
            $table->double('discount')->default(0);
            $table->json('data')->nullable();

            // SEO Part
            $table->string('meta_name')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
