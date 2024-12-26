<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'salary'
    ];
    public function loan()
    {
        return $this->hasMany(Loan::class,'employee_id');
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class,'employee_id');
    }
}
