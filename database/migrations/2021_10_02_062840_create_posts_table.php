<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('excerpt');
            $table->text('body')->nullable();
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
            $table->boolean('featured')->default(0);
            $table->bigInteger('priority')->default(1);
            $table->integer('type')->default(1);
            $table->string('video')->nullable();
            $table->string('audio')->nullable();
            $table->boolean('breaking_news')->default(0);
            $table->boolean('hot_news')->default(0);
            $table->string('seo_name')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
