<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $table = 'projets';
    protected $primaryKey = 'id_projet';
    protected $fillable = ['id_service', 'nom', 'description', 'lieu', 'client', 'date_realisation', 'image', 'status'];

    public function service() {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }
}