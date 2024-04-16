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
        Schema::create('penjualan_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_penjualan');
            $table->bigInteger('id_barang');
            $table->string('ukuran')->nullable();
            $table->integer('ukuran_p')->nullable();
            $table->integer('ukuran_l')->nullable();
            $table->integer('harga');
            $table->integer('kuantitas');
            $table->integer('diskon');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_items');
    }
};
