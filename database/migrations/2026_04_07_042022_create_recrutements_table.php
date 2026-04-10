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
    Schema::create('recrutements', function (Blueprint $table) {
        $table->id('id_recrutement');
        $table->string('nom'); // Titre du poste
        $table->string('image')->nullable();
        $table->text('description');
        $table->string('lieu');
        $table->string('agence')->nullable(); // Agence ou département
        $table->enum('type', ['CDI', 'CDD', 'Mission', 'Stage', 'Freelance'])->default('CDI');
        $table->date('date_limite');
        $table->string('email_whatsapp');
        $table->enum('status', ['brouillon', 'publié', 'cloturé'])->default('brouillon');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recrutements');
    }
};
