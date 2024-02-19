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
        Schema::create('data_penduduks', function (Blueprint $table) {
            $table->id();
            // umum

            $table->string('nik')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('alamat_rumah')->nullable();
            $table->string('no_rumah')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kampung')->nullable();
            $table->string('dusun')->nullable();
            $table->string('dapat_membaca_huruf')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('kebangsaan')->nullable();
            $table->string('suku')->nullable();
            $table->string('jenis_penambahan')->nullable();
            $table->string('jenis_pengurangan')->nullable();

            // kelahiran
            $table->string('tempat_dilahirkan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->time('jam_lahir')->nullable();
            $table->string('waktu_lahir')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('jenis_kelahiran')->nullable();
            $table->string('penolong_kelahiran')->nullable();

            $table->string('berat_bayi')->nullable();
            $table->string('panjang_bayi')->nullable();
            $table->string('akta_kelahiran')->nullable();
            $table->string('nomor_akta_kelahiran')->nullable();
            $table->date('tanggal_akta_kelahiran')->nullable();
            $table->string('tempat_diterbitkan_ktp')->nullable();
            $table->date('tanggal_diterbitkan_ktp')->nullable();
            $table->string('nomor_kk')->nullable();
            $table->string('kedudukan_dalam_keluarga')->nullable();
            $table->string('nik_ibu_kandung')->nullable();

            $table->string('nik_ayah_kandung')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->string('nama_ayah_kandung')->nullable();

            //kematian
            $table->string('tempat_kematian')->nullable();
            $table->string('desa_atau_kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten_atau_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->date('tanggal_kematian')->nullable();
            $table->time('jam_kematian')->nullable();
            $table->string('waktu_kematian')->nullable();
            $table->string('umur_saat_meninggal')->nullable();
            $table->string('sebab_kematian')->nullable();
            $table->string('yang_mengabarkan_kematian')->nullable();
            $table->string('akta_kematian')->nullable();
            $table->string('nomor_akta_kematian')->nullable();
            $table->date('tanggal_akta_kematian')->nullable();

            // nikah/cerai
            $table->string('status_perkawinan')->nullable();
            $table->string('akta_perkawinan')->nullable();
            $table->string('nomor_akta_perkawinan')->nullable();
            $table->date('tanggal_perkawinan')->nullable();
            $table->string('lokasi_perkawinan')->nullable();
            $table->string('akta_perceraian')->nullable();
            $table->string('nomor_akta_perceraian')->nullable();
            $table->date('tanggal_perceraian')->nullable();
            $table->string('lokasi_perceraian')->nullable();

            // lain-lain
            $table->text('kelainan_fisik')->nullable();
            $table->text('penyandang_cacat')->nullable();
            $table->text('pendapatan_perbulan')->nullable();
            $table->text('keterangan')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penduduks');
    }
};
