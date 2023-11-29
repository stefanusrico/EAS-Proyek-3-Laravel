<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tenan');
            $table->foreign('id_tenan')->references('id')->on('tenan');
            $table->unsignedBigInteger('id_kasir');
            $table->foreign('id_kasir')->references('id')->on('kasir');
            $table->string('nama_tenan');
            $table->string('nama_kasir');
            $table->date('tgl_nota');
            $table->time('jam_nota');
            $table->integer('jumlah_belanja');
            $table->double('diskon');
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota');
    }
};