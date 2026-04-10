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
    Schema::table('produits', function (Blueprint $table) {
        // On ajoute le nom juste après l'id du service pour la logique
        $table->string('nom')->after('id_service')->nullable(); 
    });
}

public function down(): void
{
    Schema::table('produits', function (Blueprint $table) {
        $table->dropColumn('nom');
    });
}

    /**
     * Reverse the migrations.
     */
    
};
