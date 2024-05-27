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
        Schema::create('penilaian_otentifikasis', function (Blueprint $table) {
            $table->id();
            $table->enum('penilaian_login', ['sesuai', 'tidak']);
            $table->enum('penilaian_captcha_login', ['sesuai', 'tidak']);
            $table->enum('penilaian_cpatcha_lain', ['sesuai', 'tidak']);
            $table->enum('penilaian_daftar', ['sesuai', 'tidak']);
            $table->enum('penilaian_reset_password', ['sesuai', 'tidak']);
            $table->enum('penilaian_password_8_krtr', ['sesuai', 'tidak']);
            $table->enum('penilaian_password_besar_kecil_khusus', ['sesuai', 'tidak']);
            $table->enum('penilaian_ukur_sandi', ['sesuai', 'tidak']);
            $table->enum('penilaian_tampil_sembunyi_sandi', ['sesuai', 'tidak']);
            $table->enum('penilaian_valid_email_new_user', ['sesuai', 'tidak']);
            $table->enum('penilaian_verif_admin_new_user', ['sesuai', 'tidak']);
            $table->enum('penilaian_exp_password_1_thn', ['sesuai', 'tidak']);
            $table->enum('penilaian_user_dibuat_admin', ['sesuai', 'tidak']);
            $table->enum('penilaian_reset_password_user_dibuat_admin', ['sesuai', 'tidak']);
            $table->text('cttan_penilaian_login')->nullable();
            $table->text('cttan_penilaian_captcha_login')->nullable();
            $table->text('cttan_penilaian_daftar')->nullable();
            $table->text('cttan_penilaian_reset_password')->nullable();
            $table->text('cttan_penilaian_valid_pw_8_karakter')->nullable();
            $table->text('cttan_penilaian_pw_besar_kecil_khusus')->nullable();
            $table->text('cttan_penilaian_ukur_sandi')->nullable();
            $table->text('cttan_penilaian_tampil_sembunyi_sandi')->nullable();
            $table->text('cttan_penilaian_valid_email_new_user')->nullable();
            $table->text('cttan_penilaian_verif_admin_new_user')->nullable();
            $table->text('cttan_penilaian_exp_password_1_thn')->nullable();
            $table->text('cttan_penilaian_user_dibuat_admin')->nullable();
            $table->text('cttan_penilaian_reset_pw_user_dibuat_admin')->nullable();
            $table->string('foto_valid_pw_8_karakter', 150);
            $table->string('foto_pw_besar_kecil_khusus', 150);
            $table->string('foto_exp_password_1_thn', 150);
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
        Schema::dropIfExists('penilaian_otentifikasis');
    }
};
