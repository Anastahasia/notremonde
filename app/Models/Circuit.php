<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    use HasFactory;
    protected $fillabale = [
        'nom',
        'description',
        'duree',
        'photo',
        'prix_estimatif',
        'visible',
        'id_categorie',
    ];
}
