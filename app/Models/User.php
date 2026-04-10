<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user'; // Ta clé primaire

    protected $fillable = [
        'nom_complet', 'email', 'role', 'telephone', 'password', 'confirm_password'
    ];

    protected $hidden = ['password', 'remember_token'];
}