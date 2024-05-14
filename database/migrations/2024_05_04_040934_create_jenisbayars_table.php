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
        Schema::create('jenisbayars', function (Blueprint $table) {
            $table->id();
            $table->string('nm_jenis',200);
            $table->double('biaya');
            $table->string('kelas',6);
            $table->string('ket',50);
            $table->foreignId('tp_id')->constrained()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenisbayars');
    }
};
