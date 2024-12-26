<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable=[
      'employee_id',
        'monthly_installment',
        'repayment_period',
        'start_date',
        'status'
    ];
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function loanDeduction()
    {
        return $this->hasMany(LoanDeduction::class,'loan_id');
    }
}
