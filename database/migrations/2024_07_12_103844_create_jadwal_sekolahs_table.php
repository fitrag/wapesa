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
        Schema::create('jadwal_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('mapel_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tp_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('hari');
            $table->integer('no_urut')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_sekolahs');
    }
};
