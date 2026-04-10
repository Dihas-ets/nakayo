<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = 'avis';
    protected $primaryKey = 'id_avis';
    protected $fillable = ['id_article', 'id_service', 'nom_auteur', 'email_auteur', 'note', 'commentaire', 'status'];

    // Relation avec l'article
    public function article() {
        return $this->belongsTo(Article::class, 'id_article', 'id_article');
    }

    // Relation avec le service
    public function service() {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }
}