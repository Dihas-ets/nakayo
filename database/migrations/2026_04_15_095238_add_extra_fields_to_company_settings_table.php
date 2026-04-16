<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            // Description textuelle (longue)
            $table->text('description_footer')->nullable()->after('email');
            
            // Lien RS
            $table->text('tiktok_link')->nullable()->after('linkedin_link');
            
            // Chemins vers les fichiers images
            $table->string('logo')->nullable()->after('nom_agence');
            $table->string('logo_sans_fond')->nullable()->after('logo');
            $table->string('favicon')->nullable()->after('logo_sans_fond');
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'description_footer', 
                'tiktok_link', 
                'logo', 
                'logo_sans_fond', 
                'favicon'
            ]);
        });
    }
};