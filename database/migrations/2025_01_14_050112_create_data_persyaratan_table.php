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
        Schema::create('data_persyaratan', function (Blueprint $table) {
            $table->id();
            $table->text('tentang_website')->nullable();
            $table->text('persyaratan_kelahiran')->nullable();
            $table->text('persyaratan_kematian')->nullable();
            $table->string('gambar_lp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_persyaratan');
    }
};
