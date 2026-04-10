<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallerie extends Model
{
    protected $table = 'galleries';
    protected $primaryKey = 'id_gallerie';
    protected $fillable = ['id_service', 'id_produit', 'type_media', 'link', 'image_url'];

    // Relation avec un service
    public function service() {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }

    // Relation avec un produit
    public function produit() {
        return $this->belongsTo(Produit::class, 'id_produit', 'id_produit');
    }
}