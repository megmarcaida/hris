<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCredit extends Model
{
    use HasFactory;

    public function credit(){
        return $this->hasOne(Credit::class, 'id','credit_id');
    }
}
