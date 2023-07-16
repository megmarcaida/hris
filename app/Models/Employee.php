<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function department(){
        return $this->hasOne(Department::class, 'id','department_id');
    }
    
    public function designation(){
        return $this->hasOne(Designation::class, 'id','designation_id');
    }

    public function branch(){
        return $this->hasOne(Branch::class, 'id','branch_id');
    }

    public function workshift(){
        return $this->hasOne(Workshift::class, 'id','work_shift_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function generatedPayslip(){
        return $this->belongsTo(GeneratedPayslips::class, 'employee_id');
    }
}
