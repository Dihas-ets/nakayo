<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Créer le compte ADMIN
        User::create([
            'nom_complet'      => 'Administrateur Principal',
            'email'            => 'admin@accessfinance.bj',
            'role'             => 'admin',
            'telephone'        => '+229 00 00 00 01',
            'password'         => Hash::make('admin1234'), // On crypte le mot de passe !
            'confirm_password' => 'admin1234', // Colonne de ton SQL
        ]);

        // 2. Créer le compte RÉDACTEUR
        User::create([
            'nom_complet'      => 'Jean Rédacteur',
            'email'            => 'redacteur@accessfinance.bj',
            'role'             => 'rédacteur',
            'telephone'        => '+229 00 00 00 02',
            'password'         => Hash::make('redac1234'),
            'confirm_password' => 'redac1234',
        ]);

        $this->command->info('Comptes Admin et Rédacteur créés avec succès !');
    }
}