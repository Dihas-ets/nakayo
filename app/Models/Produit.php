<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits';
    protected $primaryKey = 'id_produit';
    protected $fillable = ['id_service','nom', 'image', 'description', 'prix', 'statut', 'contact'];

    // Relation : Un produit appartient à un service
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }
}