<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvStage extends Model
{
    use HasFactory;
    protected $fillable =[
        'titre',
        'dateDebut',
        'dateFin',
       'description',
       'statut',
        'maitre_id',
        "chef_id",
        "etudiant_id",

    ];
}
