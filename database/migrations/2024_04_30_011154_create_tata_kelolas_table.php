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
        Schema::create('tata_kelolas', function (Blueprint $table) {
            $table->id();
            $table->string('dok_kak_tor', 250);
            $table->string('laporan_dpa', 250)->nullable();
            $table->string('sk_pengelola_apk', 250);
            $table->string('sk_helpdesk_apk', 250);
            $table->string('laporan_akhir', 250);
            $table->string('sop', 250);
            $table->string('panduan_apk', 250);
            $table->string('link_video_apk', 250);
            $table->string('panduan_apkserver', 250);
            $table->string('dok_mnjresiko', 250);
            $table->string('dok_api', 250);
            $table->string('file_scapk', 250);
            $table->string('file_scapk', 250);
            $table->integer('assessment_id');
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
        Schema::dropIfExists('tata_kelolas');
    }
};
