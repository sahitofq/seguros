<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkFasecModel extends Model
{
    use HasFactory;

    protected $table = "ws_markfasec";
    protected $primaryKey = 'mf_id';

    const CREATED_AT = 'mf_created';
    const UPDATED_AT = 'mf_updated';
}
