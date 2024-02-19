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
        Schema::create('transaksi_surat_masuks', function (Blueprint $table) {
            $table->uuid('kode_transaksi')->primary();
            $table->string('kode_surat') ;
            $table->text('deskripsi_pengajuan');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->json('file');
            $table->boolean('status')->nullable()->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_surat_masuks');
    }
};
