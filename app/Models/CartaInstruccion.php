<?php

namespace App\Models;

use App\Models\Sepomex\Municipio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartaInstruccion extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'carta_instruccion';
    protected $fillable = ['id_partida', 'ci', 'id_beneficiario', 'id_municipio', 'tipo_cambio', 'importe', 'concepto', 'observaciones', 'fecha'];

    public function partida()
    {
        return $this->belongsTo(Partida::class, 'id_partida');
    }

    public function beneficiario()
    {
        // withTrashed -> regresa los beneficiarios eliminados;
        return $this->belongsTo(Beneficiario::class, 'id_beneficiario')->withTrashed();
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }
}
