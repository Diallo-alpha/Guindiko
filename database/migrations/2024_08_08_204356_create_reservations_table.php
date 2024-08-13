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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentee_id')->constrained('mentees')->onDelete('cascade');
            $table->foreignId('session_mentorat_id')->constrained('session_mentorats')->onDelete('cascade');
            $table->enum('statut', ['en attente', 'confirmée', 'annulée']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
