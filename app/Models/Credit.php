<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','tax'
    ];

    public function employees(){
        return $this->belongsTo(Employee::class, 'credit_id');
    }

    public function employeeCredits(){
        return $this->belongsTo(EmployeeCredit::class, 'credit_id');
    }
}
