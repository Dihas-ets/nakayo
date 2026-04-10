<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gallerie;

class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id_service'; 
    
    protected $fillable = [
        'media', 
        'titre', 
        'courte_description', 
        'description',
        'status'
    ];


    

public function galleries()
{
    // Important : bien préciser les clés si elles ne sont pas standards
    return $this->hasMany(Gallerie::class, 'id_service', 'id_service');
}


// 🔥 ICI
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($service) {
            $service->galleries()->delete();
        });
    }


    // Dans app/Models/Service.php

public function produits()
{
    // Un service a plusieurs produits liés par id_service
    return $this->hasMany(Produit::class, 'id_service', 'id_service');
}
}