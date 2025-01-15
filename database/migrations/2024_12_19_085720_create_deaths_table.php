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
        Schema::create('deaths', function (Blueprint $table) {
            $table->id();
            $table->string('created_by')->nullable();
            $table->string('nomor_surat_kematian')->nullable()->unique();
            $table->string('nama_alm');
            $table->enum('jenis_kelamin_alm', ['Laki-laki', 'Perempuan']);
            $table->text('alamat_alm');
            $table->string('hari_kematian');
            $table->date('tanggal_kematian');
            $table->time('pukul_kematian');
            $table->string('tempat_kematian');
            $table->string('penyebab_kematian');
            $table->string('alasan_gagal')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('umur_almarhum');
            $table->enum('status_data', ['Diajukan','Ditolak', 'Disetujui'])->default('Diajukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deaths');
    }
};
