<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email'); // Correspond à adresseEmail
            $table->string('phone');
            $table->string('objet');
            $table->text('description');
            $table->boolean('is_read')->default(false); // Utile pour savoir si vous avez lu le message dans l'admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};