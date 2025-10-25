<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroVotacion extends Model
{
    protected $fillable = ['municipio_id', 'nombre', 'codigo'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function actas()
    {
        return $this->hasMany(Acta::class);
    }
}
