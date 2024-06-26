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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelanggan');
            $table->string('id_barang');
            $table->string('ukuran')->nullable();
            $table->integer('ukuran_p')->nullable();
            $table->integer('ukuran_l')->nullable();
            $table->integer('harga');
            $table->integer('kuantitas');
            $table->string('diskon')->default('0');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};
