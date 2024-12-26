<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanDeduction extends Model
{
    protected $fillable=[
        'loan_id',
        'deduction_date',
        'deduction_amount',
        'remaining_amount',
        'status'
    ];
    public function loan()
    {
        return $this->belongsTo(Loan::class,'loan_id');
    }
}
