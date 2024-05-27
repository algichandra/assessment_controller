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
        Schema::create('manajemen_sesis', function (Blueprint $table) {
            $table->id();
            $table->enum('token_url', ['ya', 'tidak']);
            $table->enum('manej_sesi', ['ya', 'tidak']);
            $table->enum('set_sesi', ['ya', 'tidak']);
            $table->enum('back_sesi_out', ['ya', 'tidak']);
            $table->enum('aunten_12_jam', ['ya', 'tidak']);
            $table->enum('satu_akun_satu_user', ['ya', 'tidak']);
            $table->enum('satu_akun_berbagai_device', ['ya', 'tidak']);
            $table->text('cttan_token_url')->nullable();
            $table->text('cttan_manej_sesi')->nullable();
            $table->text('cttan_set_sesi')->nullable();
            $table->text('cttan_back_sesi_out')->nullable();
            $table->text('cttan_auten_12_jam')->nullable();
            $table->text('cttan_satu_akun_satu_user')->nullable();
            $table->text('cttan_satu_akun_berbagai_device')->nullable();
            $table->string('foto_manej_sesi', 150);
            $table->string('foto_set_sesi', 150);
            $table->string('foto_aunten', 150);
            $table->string('foto_satu_akun_berbagai_device', 150);
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
        Schema::dropIfExists('manajemen_sesis');
    }
};
