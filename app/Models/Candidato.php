<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = ['partido_id', 'nombre', 'numero'];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function resultados()
    {
        return $this->hasMany(Resultado::class);
    }
}
