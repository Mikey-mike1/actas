<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected $fillable = ['acta_id', 'candidato_id', 'votos'];

    public function acta()
    {
        return $this->belongsTo(Acta::class);
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }
}
