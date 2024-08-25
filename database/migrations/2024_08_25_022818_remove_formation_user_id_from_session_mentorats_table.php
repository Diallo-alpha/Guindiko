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
        Schema::table('session_mentorats', function (Blueprint $table) {
            //
            $table->dropForeign(['formation_user_id']);
            $table->dropColumn('formation_user_id');

            // Ajouter la nouvelle colonne 'formation_id'
            $table->foreignId('formation_id')
                  ->constrained('formations')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('session_mentorats', function (Blueprint $table) {
            //
            $table->foreignId('formation_user_id')
            ->constrained('formation_users')
            ->onDelete('cascade');

      // Supprimer la colonne 'formation_id'
      $table->dropForeign(['formation_id']);
      $table->dropColumn('formation_id');
        });
    }
};
