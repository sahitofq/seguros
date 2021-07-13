<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesorFormModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "asesorf_form",
        "asesorf_asesor"
    ];
    protected $table = "ws_asesorform";
    protected $primaryKey = 'asesorf_id';

    const CREATED_AT = 'asesorf_created';
    const UPDATED_AT = 'asesorf_updated';
}
