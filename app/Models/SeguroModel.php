<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguroModel extends Model
{
    use HasFactory;

    protected $fillable = [
        "seguro_form_id",
        "seguro_entity_id",
        'seguro_real_seguro',
        "seguro_seguro",
        "seguro_tercero",
        "seguro_d_total",
        "seguro_h_total",
        "seguro_d_parcial",
        "seguro_h_parcial",
        "seguro_nombre",
        "seguro_tiempo",
        "seguro_pdf"
    ];

    protected $table = "ws_seguros";
    protected $primaryKey = 'seguro_id';

    const CREATED_AT = 'seguro_created';
    const UPDATED_AT = 'seguro_updated';
}
