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
        Schema::create('births', function (Blueprint $table) {
            $table->id();
            $table->string('created_by')->nullable();
            $table->string('nomor_surat')->nullable()->unique();
            $table->string('nama_anak');
            $table->enum('jenis_kelamin_anak', ['Laki-laki', 'Perempuan']);
            $table->string('hari_kelahiran');
            $table->date('tanggal_kelahiran');
            $table->string('tempat_kelahiran');
            $table->text('alamat_anak');
            $table->string('urutan_anak');
            $table->string('total_saudara');
            $table->string('nama_ayah');
            $table->string('alamat_ayah');
            $table->string('nama_ibu');
            $table->string('alamat_ibu');
            $table->string('alasan_gagal')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('foto_akta_lahir')->nullable();
            $table->enum('status_data', ['Diajukan','Ditolak', 'Disetujui'])->default('Diajukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('births');
    }

};
