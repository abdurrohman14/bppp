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
        Schema::create('pakan_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pakan_id')->constrained()->onDelete('cascade');
            $table->foreignId('kolam_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_keluar');
            $table->integer('jumlah_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakan_keluars');
    }
};
