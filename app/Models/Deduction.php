<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function employees(){
        return $this->belongsTo(Employee::class, 'deduction_id');
    }

    public function employeeDeductions(){
        return $this->belongsTo(EmployeeDeduction::class, 'deduction_id');
    }
}
