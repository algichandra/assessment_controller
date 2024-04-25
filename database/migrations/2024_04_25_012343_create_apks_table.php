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
        Schema::create('apks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_apk', 150);
            $table->string('nama_kegiatan', 150)->nullable();
            $table->string('thn_anggaran', 15)->nullable();
            $table->enum('kegiatan_dpa', ['dpa', 'non_dpa']);
            $table->text('cttan_dpa')->nullable();
            $table->string('pj', 150);
            $table->integer('opd_id');
            $table->integer('user_apk_id');
            $table->integer('jenis_kegiatan_id');
            $table->integer('developer_id');
            $table->integer('programer_id');
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
        Schema::dropIfExists('apks');
    }
};
