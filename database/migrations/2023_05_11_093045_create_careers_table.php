<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('website.table_prefix', 'website').'_'.'careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('group')->nullable();
            $table->bigInteger('position')->default(1);
            $table->string('designation');
            $table->string('location')->nullable();
            $table->string('salary');
            $table->string('deadline');
            $table->text('excerpt');
            $table->longText('description')->nullable();
            $table->json('summary')->nullable();
            $table->string('application_description')->nullable();
            $table->string('application_syllabus')->nullable();
            $table->string('application_sort_list')->nullable();
            $table->string('application_result')->nullable();
            $table->boolean('add_apply_button')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('careers');
    }
};
