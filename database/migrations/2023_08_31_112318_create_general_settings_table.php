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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('smtp_server')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_protocol')->nullable();
            $table->string('smtp_email')->nullable();
            $table->string('smtp_psw')->nullable();
            
            $table->string('siteinfo_title')->nullable();
            $table->string('siteinfo_keywords')->nullable();
            $table->string('siteinfo_description')->nullable();
            $table->string('siteinfo_fb')->nullable();
            $table->string('siteinfo_twitter')->nullable();
            $table->string('siteinfo_insta')->nullable();
            $table->string('siteinfo_google')->nullable();
            $table->string('siteinfo_googlemap')->nullable();
            $table->string('siteinfo_sl1')->nullable();
            $table->string('siteinfo_sl2')->nullable();
            $table->string('siteinfo_telephone')->nullable();
            $table->string('siteinfo_fax')->nullable();
            $table->string('siteinfo_email')->nullable();
            $table->string('siteinfo_address')->nullable();
            $table->string('siteinfo_ac')->nullable();

            $table->string('siteset_picsrc')->nullable();
            $table->string('siteset_deflang')->nullable();
            $table->string('siteset_sef')->nullable();
            $table->string('siteset_homesl')->nullable();
            $table->string('siteset_homesrv')->nullable();
            $table->string('siteset_homefeat')->nullable();
            $table->string('siteset_home3block')->nullable();
            $table->string('siteset_homeref')->nullable();
            $table->string('siteset_theme1')->nullable();
            $table->string('siteset_theme2')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
