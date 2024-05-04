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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis',15);
            $table->string('nisn',15)->nullable();
            $table->string('nm_siswa',200);
            $table->string('tmpt_lhr',100)->nullable();
            $table->date('tgl_lhr')->nullable();
            $table->string('jen_kel',1)->nullable();
            $table->string('agama',20)->nullable();
            $table->string('almt_siswa',200)->nullable();
            $table->string('no_tlp',15)->nullable();
            $table->string('nm_ayah',200)->nullable();
            $table->foreignId('kelas_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('siswa_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
