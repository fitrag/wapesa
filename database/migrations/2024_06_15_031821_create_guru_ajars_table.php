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
        Schema::create('guru_ajars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('mapel_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tp_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_ajars');
    }
};
