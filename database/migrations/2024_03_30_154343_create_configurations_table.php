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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nama_singkat');
            $table->string('kabupaten');
            $table->string('telp');
            $table->string('whatsapp');
            $table->string('email');
            $table->string('rekening_nama');
            $table->string('rekening_nomer');
            $table->string('rekening_an');
            $table->string('logo');
            $table->string('member_card');
            $table->string('logo_nota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
