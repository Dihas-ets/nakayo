<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    // Nom de la table (selon ce que tu as envoyé précédemment)
    protected $table = 'article_commentaires'; 

    // Nom de la clé primaire personnalisée
    protected $primaryKey = 'id_commentaire';

    // Les champs que l'on peut remplir via un formulaire (Mass Assignment)
    protected $fillable = [
        'id_article',
        'nom_auteur',
        'email_auteur',
        'contenu',
        'statut',
    ];

    /**
     * Relation : Un commentaire appartient à un article
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'id_article', 'id_article');
    }
}