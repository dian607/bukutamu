<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('instansi');
            $table->string('no_hp');
            $table->string('email')->nullable(); // Kolom Email (Opsional)
            $table->text('tujuan');
            $table->text('catatan')->nullable(); // Kolom Catatan (Opsional)
            $table->longText('ttd'); // Tanda tangan base64
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};