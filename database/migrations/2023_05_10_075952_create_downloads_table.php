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
        Schema::create(config('website.table_prefix', 'website').'_'.'downloads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('group')->default(1);
            $table->boolean('active')->default(1);
            $table->bigInteger('position')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
