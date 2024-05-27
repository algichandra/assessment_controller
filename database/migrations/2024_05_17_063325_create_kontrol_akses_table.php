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
        Schema::create('kontrol_akses', function (Blueprint $table) {
            $table->id();
            $table->enum('user_lvl_manej', ['ya', 'tidak']);
            $table->enum('dshbrd_admin', ['ya', 'tidak']);
            $table->enum('verif_token', ['ya', 'tidak']);
            $table->enum('anti_csrf', ['ya', 'tidak']);
            $table->enum('pnjelajah_dirt', ['ya', 'tidak']);
            $table->text('cttan_user_lvl_manej')->nullable();
            $table->text('cttan_dshbrd_admin')->nullable();
            $table->text('cttan_verif_token')->nullable();
            $table->text('cttan_anti_csrf')->nullable();
            $table->text('cttan_pnjelajah_dirt')->nullable();
            $table->string('foto_data_validasi', 150);
            $table->string('foto_dashbrd_admin', 150);
            $table->string('foto_anti_csrf', 150);
            $table->string('foto_penjelajahan_direktori', 150);
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
        Schema::dropIfExists('kontrol_akses');
    }
};
