<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chefDepartement extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'numTel',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
