<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $table = 'formations';
    protected $primaryKey = 'id_formation';
    protected $fillable = [
        'id_service', 'titre', 'description', 'lieu', 
        'date_formation', 'cout', 'status', 'contact'
    ];

    // Relation : Une formation appartient à un service
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service', 'id_service');
    }
}