<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesorModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "asesor_correo",
        "asesor_nombre",
        "asesor_estado",
        "asesor_telefono"
    ];
    protected $table = "ws_asesor";
    protected $primaryKey = 'asesor_id';

    const CREATED_AT = 'asesor_created';
    const UPDATED_AT = 'asesor_updated';
}
