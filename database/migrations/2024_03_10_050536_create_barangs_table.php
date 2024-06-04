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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->enum('jenis', ['1','2']); //1 = Buah(X Lembar), 2 = Dimens(X Ukuran)
            $table->enum('status', ['active','disable']); //1 = Buah(X Lembar), 2 = Dimens(X Ukuran)
            $table->integer('stok')->default('0');
            $table->bigInteger('id_kategori')->constrained('kategoris')->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('id_satuan')->constrained('units')->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('id_harga')->constrained('hargas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
