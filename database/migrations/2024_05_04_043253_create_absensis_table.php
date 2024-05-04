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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->string('nis',15);
            $table->foreignId('kelas_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tp_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('semester',8);
            $table->enum('hadir',['h','s','i','a','al']);
            $table->string('ket',25)->nullable();
            $table->string('username',25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
