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
        Schema::create('penilaian_tata_kelolas', function (Blueprint $table) {
            $table->id();
            $table->enum('penilaian_dok_kak_tor', ['sesuai', 'tidak']);
            $table->enum('penilaian_laporan_dpa', ['sesuai', 'tidak']);
            $table->enum('penilaian_sk_pengelola_apk', ['sesuai', 'tidak']);
            $table->enum('penilaian_sk_helpdesk_apk', ['sesuai', 'tidak']);
            $table->enum('penilaian_laporan_akhir', ['sesuai', 'tidak']);
            $table->enum('penilaian_sop', ['sesuai', 'tidak']);
            $table->enum('penilaian_panduan_apk', ['sesuai', 'tidak']);
            $table->enum('penilaian_link_video_apk', ['sesuai', 'tidak']);
            $table->enum('penilaian_panduan_apkserver', ['sesuai', 'tidak']);
            $table->enum('penilaian_dok_mnjresiko', ['sesuai', 'tidak']);
            $table->enum('penilaian_dok_api', ['sesuai', 'tidak']);
            $table->enum('penilaian_file_scapk', ['sesuai', 'tidak']);
            $table->text('cttan_penilaian_kak_tor')->nullable();
            $table->text('cttan_penilaian_lap_awal')->nullable();
            $table->text('cttan_penilaian_sk_pengelola_apk')->nullable();
            $table->text('cttan_penilaian_sk_helpdesk_apk')->nullable();
            $table->text('cttan_penilaian_lap_akhir')->nullable();
            $table->text('cttan_penilaian_sop')->nullable();
            $table->text('cttan_penilaian_pduan_pnglola')->nullable();
            $table->text('cttan_penilaian_vid_tutor_apk')->nullable();
            $table->text('cttan_penilaian_pand_apkserver')->nullable();
            $table->text('cttan_penilaian_manej_resiko')->nullable();
            $table->text('cttan_penilaian_dok_api')->nullable();
            $table->text('cttan_penilaian_source_code')->nullable();
            $table->integer('tata_kelola_id');
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
        Schema::dropIfExists('penilaian_tata_kelolas');
    }
};
