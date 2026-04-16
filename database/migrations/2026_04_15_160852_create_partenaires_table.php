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
    Schema::create('partenaires', function (Blueprint $table) {
        $table->id('id_partenaire'); // Clé primaire personnalisée
        $table->string('nom');
        $table->string('image')->nullable(); // Chemin du logo
        $table->string('lien')->nullable();  // Lien vers leur site web
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
