<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $fillable = [
        'nip', 'name', 'fungsional', 'address', 'regency', 'district', 'sub_district', 'place_of_birth', 'date_of_birth', 'nik', 'identity_number', 'identity_address', 'identity_regency', 'identity_subdistrict', 'user_dept_id', 'company_id', 'start_date', 'user_id', 'gender', 'marital_status', 'height', 'weight'
    ];
}
