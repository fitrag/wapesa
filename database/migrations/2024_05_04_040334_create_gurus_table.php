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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nip',15)->nullable();
            $table->string('nuptk',15)->nullable();
            $table->string('nm_guru',200);
            $table->string('tmpt_lhr',100)->nullable();
            $table->date('tgl_lhr')->nullable();
            $table->string('jen_kel',1)->nullable();
            $table->string('agama',20)->nullable();
            $table->string('almt',200)->nullable();
            $table->string('no_tlp',15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
