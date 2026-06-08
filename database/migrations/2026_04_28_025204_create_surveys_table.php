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
        Schema::create('surveis', function (Blueprint $table) {
            $table->id();
            // Kolom baru sesuai form yang disederhanakan
            $table->string('nama')->nullable(); // nullable berarti boleh dikosongkan (anonim)
            $table->string('kepuasan');         // Isinya akan "Puas" atau "Tidak Puas"
            $table->text('saran')->nullable();  // nullable berarti boleh dikosongkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveis');
    }
};