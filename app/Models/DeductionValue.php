<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionValue extends Model
{
    use HasFactory;
    protected $table = 'deduction_values';
    protected $fillable = [
        'employee_id',
        'deduction_id',
        'field_name',
        'value',
        'type',
        'tax'
    ];
}
