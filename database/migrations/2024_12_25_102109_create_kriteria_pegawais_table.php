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
        Schema::create('kriteria_pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')
            ->constrained('pegawais')
            ->onDelete('cascade');
            $table->foreignId('subkriteria_id')
            ->constrained('subkriterias')
            ->onDelete('cascade');
            $table->decimal('bobot',5,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_pegawais');
    }
};
