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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('foto', 955)->nullable();
            $table->string('username');
            $table->string('password');
            $table->enum('level',['admin','guru','siswa']);
            $table->boolean('is_walas')->default(0);
            $table->boolean('is_gurupiket')->default(0);
            $table->boolean('is_bendahara')->default(0);
            $table->boolean('is_kepsek')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
