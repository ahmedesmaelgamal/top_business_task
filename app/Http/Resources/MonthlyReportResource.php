<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'employee_name'=>$this->employee_name,
            'attendance_month'=>$this->attendance_month,
            'total_attendance'=>$this->total_attendance,
            'loan_amount'=>$this->loan_amount,
            'repayment_period'=>$this->repayment_period,
            'repayment_start_date'=>$this->repayment_start_date,
            'base_salary'=>$this->base_salary,
            'net_salary'=>$this->net_salary,
        ];
    }
}
