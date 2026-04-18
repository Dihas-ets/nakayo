<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
 use Illuminate\Support\Facades\Storage;

class Partenaire extends Model
{
    use HasFactory;

    protected $table = 'partenaires';
    protected $primaryKey = 'id_partenaire';

    protected $fillable = [
        'nom',
        'image',
        'lien',
    ];


   






protected function imageUrl(): Attribute
{
    return Attribute::get(function () {

        if (!$this->image) {
            return url('images/default.png');
        }

        // 🔥 Cloudinary (URL complète)
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // 🔥 LOCAL → forcer /storage/
        if (config('filesystems.default') === 'public') {
            return asset('storage/' . $this->image);
        }

        // 🔥 CLOUD → générer via Storage
        return Storage::url($this->image);
    });
}



}