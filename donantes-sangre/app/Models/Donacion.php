<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
     
    protected $table = 'donaciones';
    protected $primaryKey = 'id_donacion';
    
    //Desactivo timestamps
    public $timestamps = false;
    
    protected $fillable = [
        'id_donacion',
        'id_donante',
        'fecha_donacion',
        'centro',
        'tipo_donacion',
        'cantidad_ml'
    ];
    //Donante al que pertenece la donación
    public function donante()
    {
        return $this->belongsTo(Donante::class, 'id_donante', 'id_donante');
    }
}
