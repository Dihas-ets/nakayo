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
    Schema::create('avis', function (Blueprint $table) {
        $table->id('id_avis'); // Clé primaire style Nakayo
        $table->unsignedBigInteger('id_article')->nullable(); // Si c'est un comm. de blog
        $table->unsignedBigInteger('id_service')->nullable(); // Si c'est un avis sur un service
        $table->string('nom_auteur');
        $table->string('email_auteur');
        $table->integer('note')->default(5); // Note de 1 à 5 étoiles
        $table->text('commentaire');
        $table->enum('status', ['en_attente', 'approuvé', 'rejeté'])->default('en_attente');
        $table->timestamps();

        // Foreign keys
        $table->foreign('id_article')->references('id_article')->on('articles')->onDelete('cascade');
        $table->foreign('id_service')->references('id_service')->on('services')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
