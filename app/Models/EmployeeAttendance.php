<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;
    protected $table = 'employee_attendances';
    protected $fillable = [
        'unique_id',
        'in_out_time',
        'Memoinfo',
        'WorkCode',
    ];
}
