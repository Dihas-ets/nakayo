<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('marques', function (Blueprint $table) {
        // ID spécifique comme tu l'as demandé
        $table->id('id_marque'); 
        
        $table->string('nom');
        $table->string('image')->nullable(); // Le chemin du logo/image
        
        // Clé étrangère vers la table services
        // unsignedBigInteger car c'est le type par défaut des ID Laravel
        // nullable() car c'est facultatif
        $table->unsignedBigInteger('id_service')->nullable();

        // Définition de la contrainte de clé étrangère
        // onDelete('set null') : si le service est supprimé, la marque reste mais id_service devient vide
        $table->foreign('id_service')
              ->references('id_service') 
              ->on('services')
              ->onDelete('set null');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marques');
    }
};
