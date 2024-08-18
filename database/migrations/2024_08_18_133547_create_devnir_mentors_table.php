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
        Schema::create('devnir_mentors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('parcours_academique');
            $table->string('diplome');
            $table->string('langue');
            $table->string('cv');
            $table->text('experience');
            $table->string('domaine');
            $table->enum('statut', ['en attente', 'validée', 'rejetée'])->default('en attente');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devnir_mentors');
    }
};
