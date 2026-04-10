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
    Schema::table('services', function (Blueprint $table) {
        // On ajoute le champ status après la description
        // On utilise 'brouillon' comme valeur par défaut
        $table->enum('status', ['publié', 'brouillon'])->default('publié')->after('description');
    });
}

public function down(): void
{
    Schema::table('services', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
