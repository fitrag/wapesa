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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('mapel_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tp_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tgl');
            $table->string('jamke',20);
            $table->text('materi');
            $table->integer('tmke');
            $table->string('status');
            $table->text('absensi');
            $table->text('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
