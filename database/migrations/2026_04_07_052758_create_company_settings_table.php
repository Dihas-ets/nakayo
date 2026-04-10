<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('ifu')->nullable();
            $table->string('nom_agence')->nullable();
            $table->string('telephone_appel')->nullable();
            $table->string('telephone_whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('localisation')->nullable();
            $table->text('google_maps_link')->nullable();
            $table->text('facebook_link')->nullable();
            $table->text('instagram_link')->nullable();
            $table->text('linkedin_link')->nullable();
            $table->text('availability_hours')->nullable();
            $table->timestamps();
        });

        // TRÈS IMPORTANT : On insère une ligne vide par défaut
        // pour que le contrôleur puisse faire "CompanySetting::first()" sans erreur
        DB::table('company_settings')->insert([
            'nom_agence' => 'NAKAYO CORPORATION Sarl',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};