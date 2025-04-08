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
        Schema::create('penebaran_benihs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->references('id')->on('kolams')->onDelete('cascade');
            $table->foreignId('spesies_id')->references('id')->on('spesies')->onDelete('cascade');
            $table->decimal('ukuran');
            $table->string('asal_benih');
            $table->date('tanggal_tebar');
            $table->integer('jumlah_benih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penebaran_benihs');
    }
};
