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
        Schema::table('ulaznice', function (Blueprint $table) {
            $table->renameColumn('statusUlaznice','status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ulaznice', function (Blueprint $table) {
            $table->renameColumn('status','statusUlaznice');
        });
    }
};
