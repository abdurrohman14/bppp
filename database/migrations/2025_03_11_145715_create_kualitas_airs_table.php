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
        Schema::create('kualitas_airs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->references('id')->on('kolams')->onDelete('cascade');
            $table->date('tanggal_pengukuran');
            $table->integer('pH');
            $table->integer('temperature');
            $table->integer('do');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kualitas_airs');
    }
};
