<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;

    // On précise le nom de la table si elle est différente du pluriel anglais automatique
    protected $table = 'marques';

    // On précise la clé primaire personnalisée
    protected $primaryKey = 'id_marque';

    // Les champs remplissables
    protected $fillable = [
        'nom',
        'image',
        'id_service'
    ];

    /**
     * Relation : Une marque appartient peut-être à un service
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }
}