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
        Schema::create('hosting_sub_domains', function (Blueprint $table) {
            $table->id();
            $table->enum('collocation_server', ['ya', 'tidak']);
            $table->enum('hosting', ['ya', 'tidak']);
            $table->enum('sub_domain', ['ya', 'tidak']);
            $table->string('nama_subdomain', 50);
            $table->text('cttan_collock_server')->nullable();
            $table->text('cttan_hosting')->nullable();
            $table->text('cttan_sub_domain')->nullable();
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
        Schema::dropIfExists('hosting_sub_domains');
    }
};
