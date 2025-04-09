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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained(
                table: 'siswas',
                indexName:'siswas_id'
            )->onDelete('cascade');
            $table->enum('kehadiran', ['Hadir', 'Alfa', 'Izin', 'Sakit', 'Terlambat',])->default('Terlambat');
            $table->text('lokasi'); //nerdasarkan lokasi user
            $table->string('keterangan')->nullable(); //untuk izin/terlambat
            $table->text('bukti')->nullable(); //untuk sakir
            $table->enum('absen', ['belum', 'sudah'])->default('sudah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
