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
        Schema::create('kategorijeulaznica', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dogadjajId')->constrained('sportskidogadjaji')->cascadeOnDelete();

            $table->string('naziv');
            $table->enum('tipSedista', ['REGULAR', 'VIP', 'FAN_PIT']);
            $table->decimal('cena', 8, 2);
            $table->integer('kapacitet');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategorijeulaznica');
    }
};
