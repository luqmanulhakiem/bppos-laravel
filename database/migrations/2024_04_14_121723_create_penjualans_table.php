<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota');
            $table->bigInteger('id_pelanggan');
            $table->bigInteger('id_kasir');
            $table->date('tgl_penjualan');
            $table->integer('sub_total');
            $table->string('diskon');
            $table->integer('grand_total');
            $table->date('tgl_pengambilan');
            $table->integer('bayar');
            $table->integer('sisa');
            $table->enum('status_bayar', ['belum', 'lunas']);
            $table->enum('status', ['belum', 'selesai'])->default('belum');
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
