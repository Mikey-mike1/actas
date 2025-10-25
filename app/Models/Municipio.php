<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $fillable = ['codigo', 'nombre'];

    public function centros()
    {
        return $this->hasMany(CentroVotacion::class);
    }
}

