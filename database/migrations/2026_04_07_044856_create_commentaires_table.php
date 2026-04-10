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
    // 1. On supprime le champ inutile dans articles
    Schema::table('articles', function (Blueprint $table) {
        $table->dropColumn('commentaire');
    });

    // 2. On crée la table commentaires
    Schema::create('commentaires', function (Blueprint $table) {
        $table->id('id_commentaire');
        $table->unsignedBigInteger('id_article'); // Liaison
        $table->string('nom_auteur');
        $table->string('email_auteur');
        $table->text('contenu');
        $table->enum('statut', ['en_attente', 'approuvé', 'rejeté'])->default('en_attente');
        $table->timestamps();

        // La liaison (clé étrangère)
        $table->foreign('id_article')->references('id_article')->on('articles')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
