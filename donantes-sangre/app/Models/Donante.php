<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donante extends Model
{
    use HasFactory;

    protected $table = 'donantes';
    protected $primaryKey = 'id_donante'; 

    //Desactivo timestamps
    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'apellidos',
        'grupo_sanguineo',
        'contacto',
        'fecha_nacimiento',
        'ciudad_residencia',
        'observaciones'
    ];

    //Todas las donaciones asociadas a este donante
    public function donaciones()
    {
        return $this->hasMany(Donacion::class, 'id_donante', 'id_donante');
        
    }
}
