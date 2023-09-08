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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->string('short_desc');
            $table->string('url');
            $table->string('out_link');
            $table->string('icon_type');
            $table->string('show_home');
            $table->string('list_background');
            $table->text('description');
            $table->string('seo_title');
            $table->string('seo_keywords');
            $table->text('seo_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
