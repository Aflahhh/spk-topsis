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
        Schema::create('subkriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')
            ->constrained('kriterias')
            ->onDelete('cascade');
            $table->string('nama_subkriteria'); 
            $table->enum('fungsi', ['cost', 'benefit']); 
            $table->timestamps();          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subkriterias');
    }
};
