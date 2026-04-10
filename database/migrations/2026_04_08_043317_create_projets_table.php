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
    Schema::create('projets', function (Blueprint $table) {
        $table->id('id_projet');
        $table->unsignedBigInteger('id_service'); // Liaison avec l'expertise
        $table->string('nom');
        $table->text('description');
        $table->string('lieu')->nullable(); // Ex: Cotonou, Zone Industrielle
        $table->string('client')->nullable(); // Ex: État Béninois, Particulier...
        $table->date('date_realisation')->nullable();
        $table->string('image')->nullable(); // Image principale
        $table->enum('status', ['brouillon', 'publié'])->default('publié');
        $table->timestamps();

        $table->foreign('id_service')->references('id_service')->on('services')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
