<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('main_category_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('active')->default(1);
            $table->string('color')->default(random_color());
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('position')->default(0);

            $table->string('meta_name')->nullable();
            $table->string('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
