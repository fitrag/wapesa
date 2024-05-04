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
        Schema::create('riwayatbayars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->datetime('tgl');
            $table->double('jumlah_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayatbayars');
    }
};
