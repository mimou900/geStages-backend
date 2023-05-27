<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offers extends Model
{
    use HasFactory;
    protected $fillable =[
        'titre',
        'dateDebut',
        'dateFin',
       'description',
        'maitre_id',
        "entreprise_id",

    ];
}
