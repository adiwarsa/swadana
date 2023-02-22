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
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_motor');
            $table->string('slug');
            $table->double('harga_sewa');
            $table->double('denda');
            $table->date('samsat');
            $table->text('gambar')->nullable();
            $table->string('bahan_bakar');
            $table->string('transmisi');
            $table->string('status')->default('Tersedia');
            $table->string('deskripsi')->nullable();
            $table->tinyInteger('remind')->default(0);
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
        Schema::dropIfExists('motors');
    }
};
