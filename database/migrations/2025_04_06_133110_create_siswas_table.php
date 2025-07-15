<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName:'siswas_user_id'
            )->onDelete('cascade');
            $table->text('image')->nullable();
            $table->string('nis')->nullable();
            $table->string('name');
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->enum('lengkap', ['sudah','belum'])->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
