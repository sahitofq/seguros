<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "ct_name",
        "ct_equidad",
        "ct_estado",
        "ct_bolivar",
        "ct_previsora"
    ];
    protected $table = "ws_cities";
    protected $primaryKey = 'ct_id';

    const CREATED_AT = 'ct_created';
    const UPDATED_AT = 'ct_updated';
}
