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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('jenisbayar_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tp_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nis');
            $table->datetime('tgl');
            $table->double('potongan');
            $table->double('total_bayar');
            $table->double('sisa_bayar');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
