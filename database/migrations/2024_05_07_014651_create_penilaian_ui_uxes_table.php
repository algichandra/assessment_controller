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
        Schema::create('penilaian_ui_uxes', function (Blueprint $table) {
            $table->id();
            $table->enum('penilaian_warna', ['sesuai', 'tidak']);
            $table->enum('penilaian_logo_kotabgr', ['sesuai', 'tidak']);
            $table->enum('penilaian_logo_apk', ['sesuai', 'tidak']);
            $table->enum('penilaian_copyright_pemkot', ['sesuai', 'tidak']);
            $table->enum('penilaian_info_identitasopd', ['sesuai', 'tidak']);
            $table->enum('penilaian_info_apk', ['sesuai', 'tidak']);
            $table->enum('penilaian_faq', ['sesuai', 'tidak']);
            $table->enum('penilaian_user_friendly', ['sesuai', 'tidak']);
            $table->enum('penilaian_fungsionalitas', ['sesuai', 'tidak']);
            $table->enum('penilaian_dashboard', ['sesuai', 'tidak']);
            $table->enum('penilaian_log_user', ['sesuai', 'tidak']);
            $table->text('cttan_penilaian_warna')->nullable();
            $table->text('cttan_penilaian_logo_kota')->nullable();
            $table->text('cttan_penilaian_logo_apk')->nullable();
            $table->text('cttan_penilaian_cr_pemkot')->nullable();
            $table->text('cttan_penilaian_identitas_odp')->nullable();
            $table->text('cttan_penilaian_info_apk')->nullable();
            $table->text('cttan_penilaian_faq')->nullable();
            $table->text('cttan_penilaian_uiux_frendly')->nullable();
            $table->text('cttan_penilaian_fungsionalitas')->nullable();
            $table->text('cttan_penilaian_dashboard')->nullable();
            $table->text('cttan_penilaian_log_usr')->nullable();
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
        Schema::dropIfExists('penilaian_ui_uxes');
    }
};
