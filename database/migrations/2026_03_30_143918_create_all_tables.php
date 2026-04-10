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
    Schema::create('users', function (Blueprint $table) {
        $table->id('id_user');
        $table->string('nom_complet');
        $table->string('email')->unique();
        $table->enum('role', ['admin', 'abonné', 'rédacteur'])->default('abonné');
        $table->string('telephone')->nullable();
        $table->string('password');
        $table->string('confirm_password'); // Note: Généralement non stocké, mais je le mets selon ton SQL
        $table->timestamps();
    });

    Schema::create('categories', function (Blueprint $table) {
        $table->id('id_categorie');
        $table->string('nom');
        $table->string('slug')->unique();
        $table->boolean('status')->default(true);
        $table->timestamps();
    });

    Schema::create('services', function (Blueprint $table) {
        $table->id('id_service');
        $table->string('media')->nullable();
        $table->string('titre');
        $table->string('courte_description')->nullable();
        $table->text('description')->nullable();
        $table->timestamps();
    });

    Schema::create('articles', function (Blueprint $table) {
        $table->id('id_article');
        $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');
        $table->foreignId('id_categorie')->constrained('categories', 'id_categorie')->onDelete('cascade');
        $table->string('titre');
        $table->text('description');
        $table->string('tag')->nullable();
        $table->integer('vue')->default(0);
        $table->enum('status', ['brouillon', 'publié'])->default('brouillon');
        $table->string('slug')->unique();
        $table->integer('likes')->default(0);
        $table->string('media')->nullable();
        $table->boolean('featured')->default(false);
        $table->timestamps();
    });

    Schema::create('formations', function (Blueprint $table) {
        $table->id('id_formation');
        $table->foreignId('id_service')->constrained('services', 'id_service')->onDelete('cascade');
        $table->string('titre');
        $table->text('description')->nullable();
        $table->string('lieu')->nullable();
        $table->dateTime('date_formation')->nullable();
        $table->decimal('cout', 10, 2)->nullable();
        $table->enum('status', ['ouvert', 'fermé', 'terminé'])->default('ouvert');
        $table->string('contact')->nullable();
        $table->timestamps();
    });

    Schema::create('produits', function (Blueprint $table) {
        $table->id('id_produit');
        $table->foreignId('id_service')->constrained('services', 'id_service')->onDelete('cascade');
        $table->string('image')->nullable();
        $table->text('description')->nullable();
        $table->decimal('prix', 10, 2)->nullable();
        $table->enum('statut', ['disponible', 'en_rupture'])->default('disponible');
        $table->string('contact')->nullable();
        $table->timestamps();
    });

    Schema::create('galleries', function (Blueprint $table) {
        $table->id('id_gallerie');
        $table->foreignId('id_service')->nullable()->constrained('services', 'id_service')->onDelete('set null');
        $table->foreignId('id_produit')->nullable()->constrained('produits', 'id_produit')->onDelete('set null');
        $table->enum('type_media', ['image', 'video']);
        $table->string('link')->nullable();
        $table->string('image_url')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_tables');
    }
};
