<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKualitasAirsTable extends Migration
{
    public function up()
    {
        Schema::create('kualitas_airs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kolam_id')->constrained('kolams')->onDelete('cascade');
            $table->date('tanggal_pengukuran');
            $table->decimal('ph', 5, 2);
            $table->decimal('temperatur', 5, 2);
            $table->decimal('oksigen_terlarut', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kualitas_airs');
    }
}
