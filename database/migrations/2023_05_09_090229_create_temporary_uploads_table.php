<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(config('website.table_prefix', 'website').'_'.'temporary_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->timestamps();
        });
    }
};
