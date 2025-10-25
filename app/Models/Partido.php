<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $fillable = ['nombre', 'siglas', 'color'];

    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }
}
