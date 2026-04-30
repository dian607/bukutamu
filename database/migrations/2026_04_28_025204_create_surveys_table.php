<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable(); // Opsional (Boleh kosong)
            $table->integer('kualitas');
            $table->integer('fasilitas');
            $table->integer('keramahan');
            $table->integer('kecepatan');
            $table->text('saran')->nullable(); // Opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};