<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditValue extends Model
{
    use HasFactory;
    protected $table = 'credit_values';
    protected $fillable = [
        'employee_id',
        'credit_id',
        'field_name',
        'value',
        'type',
        'tax'
    ];
}
