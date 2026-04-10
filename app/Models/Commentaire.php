<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire';
    protected $fillable = ['id_article', 'nom_auteur', 'email_auteur', 'contenu', 'statut'];

    // Liaison inverse : Le commentaire appartient à un article
    public function article()
    {
        return $this->belongsTo(Article::class, 'id_article', 'id_article');
    }
}
