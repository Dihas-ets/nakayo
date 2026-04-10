<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $table = 'articles';
    protected $primaryKey = 'id_article';
    protected $fillable = [
        'id_user', 'id_categorie', 'titre', 'description', 
        'tag', 'vue', 'status', 'slug', 'media', 'featured', 'likes'
    ];


   

    public function categorie() { return $this->belongsTo(Category::class, 'id_categorie', 'id_categorie'); }
    public function auteur() { return $this->belongsTo(User::class, 'id_user', 'id_user'); }
     public function commentaires()
{
    return $this->hasMany(Commentaire::class, 'id_article', 'id_article');
}


}