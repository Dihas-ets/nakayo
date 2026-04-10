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
    Schema::create('equipe', function (Blueprint $table) {
        $table->id('id_membre');
        $table->string('nom_complet');
        $table->string('poste'); // Ex: Directeur Technique
        $table->string('photo')->nullable();
        $table->string('linkedin')->nullable();
        $table->integer('ordre')->default(0); // Pour choisir qui apparaît en premier
        $table->boolean('statut')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipe');
    }
};
