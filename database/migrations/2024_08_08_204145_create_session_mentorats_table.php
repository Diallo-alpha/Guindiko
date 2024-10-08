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
        Schema::create('session_mentorats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->default(1)->constrained()->onDelete('cascade');
            $table->foreignId('formation_user_id')->constrained('formation_users')->onDelete('cascade');
            $table->dateTime('date');
            $table->enum('statut', ['en attente', 'confirmée', 'terminée', 'annulée'])->default('en attente');
            $table->integer('duree');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('session_mentorats');

        Schema::enableForeignKeyConstraints();
    }
};
