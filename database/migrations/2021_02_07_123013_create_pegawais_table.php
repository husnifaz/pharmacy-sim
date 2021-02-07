<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id');
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->smallInteger('gender')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('no_telp', 16)->nullable();
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
        Schema::dropIfExists('pegawai');
    }
}
