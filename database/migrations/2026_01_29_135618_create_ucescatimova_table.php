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
        Schema::create('ucescatimova', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dogadjajId')->constrained('sportskidogadjaji')->cascadeOnDelete();

            $table->foreignId('timId')->constrained('timovi')->cascadeOnDelete();

            $table->string('uloga');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ucescatimova');
    }
};
