<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormModel extends Model
{
    use HasFactory;

    protected $fillable = [
        "form_person_name",
        "form_person_doctype",
        "form_person_docnumber",
        "form_person_gender",
        "form_person_birth",
        "form_person_email",
        "form_person_phone",
        "form_vehi_placa",
        "form_vehi_marca",
        "form_vehi_model",
        "form_vehi_code",
        "form_vehi_used",
        "form_vehi_city",
        'form_vehi_brand',
        'form_vehi_brandline',
        'form_vehi_classid',
        'form_vehi_valorasegurado',
    ];

    protected $table = "ws_forms";
    protected $primaryKey = 'form_id';

    const CREATED_AT = 'form_created';
    const UPDATED_AT = 'form_updated';
}
