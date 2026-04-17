<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            // Ajout des nouveaux champs
            $table->integer('annee_creation')->nullable()->after('nom_agence');
            $table->string('horaires_ouverture')->nullable()->after('email');
            $table->string('jours_ouverture')->nullable()->after('horaires_ouverture');
            $table->string('statut_juridique')->nullable()->after('annee_creation');
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            // Suppression des champs en cas de rollback
            $table->dropColumn(['annee_creation', 'horaires_ouverture', 'jours_ouverture', 'statut_juridique']);
        });
    }
};