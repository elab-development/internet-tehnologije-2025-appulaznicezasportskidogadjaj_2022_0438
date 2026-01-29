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
        Schema::create('ulaznice', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kategorijaUlaznicaId')->constrained('kategorijeulaznica')->cascadeOnDelete();

            $table->foreignId('korisnikId')->constrained('users')->cascadeOnDelete();

            $table->enum('status', ['AKTIVNA', 'ISKORISCENA', 'OTKAZANA'])->default('AKTIVNA');

            $table->string('qrKod')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulaznice');
    }
};
