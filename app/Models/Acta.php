<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
    protected $fillable = ['municipio_id', 'centro_votacion_id', 'jrv', 'pdf_path', 'observaciones'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function centro()
    {
        return $this->belongsTo(CentroVotacion::class, 'centro_votacion_id');
    }

    public function resultados()
    {
        return $this->hasMany(Resultado::class);
    }
}
