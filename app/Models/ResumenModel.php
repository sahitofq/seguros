<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumenModel extends Model
{
    use HasFactory;

    protected $table = "ws_resumen";
    protected $primaryKey = 'resumen_id';

}
