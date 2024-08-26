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
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la clé étrangère et la colonne formation_id
            $table->dropForeign(['formation_id']);
            $table->dropColumn('formation_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Recréer la colonne et la clé étrangère si besoin
            $table->foreignId('formation_id')->default(1)->constrained('formations')->onDelete('cascade');
        });
    }
};
