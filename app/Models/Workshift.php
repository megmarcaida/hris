<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshift extends Model
{
    use HasFactory;
    protected $table = 'work_shifts';
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'late_count_time'
    ];

    public function employees(){
        return $this->belongsTo(Employee::class, 'work_shift_id');
    }
}
