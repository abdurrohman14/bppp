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
        Schema::create('kematians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->references('id')->on('kolams')->onDelete('cascade');
            $table->foreignId('spesies_id')->references('id')->on('spesies')->onDelete('cascade');
            $table->date('tanggal_kematian');
            $table->integer('jumlah_mati');
            $table->string('penyebab');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kematians');
    }
};
