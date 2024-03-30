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
        Schema::create('barang_in_outs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->bigInteger('id_barang')->constrained('barangs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('id_penyuplai')->constrained('suppliers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('id_user')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('ukuran')->nullable();
            $table->integer('ukuran_p')->nullable();
            $table->integer('ukuran_l')->nullable();
            $table->integer('kuantiti');
            $table->enum('status', ["masuk", "keluar"]);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_in_outs');
    }
};
