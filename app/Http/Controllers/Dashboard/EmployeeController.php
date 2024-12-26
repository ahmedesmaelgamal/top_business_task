<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function __construct(private EmployeeService $service)
    {

    }

    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function show($id)
    {


//        SELECT
//    e.name AS employee_name,
//    MONTH(a.date) AS attendance_month,
//    YEAR(a.date) AS attendance_year, -- Include the year to distinguish attendance across years
//    COALESCE(l.amount, 0) AS loan_amount,
//    l.repayment_period AS repayment_period,
//    l.start_date AS repayment_start_date,
//    e.salary AS base_salary,
//    COUNT(DISTINCT a.id) AS total_attendances -- Use DISTINCT to ensure unique attendance counts
//FROM employees e
//LEFT JOIN attendances a ON e.id = a.employee_id
//LEFT JOIN loans l ON e.id = l.employee_id
//    AND MONTH(l.start_date) = MONTH(a.date)
//    AND YEAR(l.start_date) = YEAR(a.date) -- Match year as well for precise loan association
//    GROUP BY e.id, e.name, YEAR(a.date), MONTH(a.date), l.amount
//ORDER BY e.name, attendance_year, attendance_month;


        $employee = Employee::with('attendance', 'loan')->find($id);

        $monthlyReport=$this->service->getMonthlyReport();

        $countAttendances = $monthlyReport['countAttendances'];
        $netSalaries = $monthlyReport['netSalaries'];


//            dd($net_salaries);
        return view('employee.show', compact('employee', 'countAttendances', 'netSalaries'));
    }


}
