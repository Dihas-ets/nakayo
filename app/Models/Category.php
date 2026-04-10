<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_categorie'; // <--- INDISPENSABLE
    protected $fillable = ['nom', 'slug', 'status'];

    public function articles() {
        return $this->hasMany(Article::class, 'id_categorie', 'id_categorie');
    }
}