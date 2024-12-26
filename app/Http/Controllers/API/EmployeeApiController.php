<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeRecource;
use App\Http\Resources\EmployeeResourceCollection;
use App\Http\Resources\MonthlyReportResourceCollection;
use App\Models\Employee;
use App\Services\EmployeeService;
use App\Traits\HttpResponseTrait;

use Illuminate\Http\Response;


class EmployeeApiController extends Controller
{
    use HttpResponseTrait;

    public function __construct(private EmployeeService $service)
    {

    }

    public function index()
    {
        try {
            $employees = Employee::all();
//         dd($employees);
        return $this->success(new EmployeeResourceCollection($employees), "Employees retrieved successfully", Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error( "unable to retrieve Employees", Response::HTTP_BAD_REQUEST);

        }
    }

    public function show($id)
    {
        try {
            $monthlyReport = $this->service->getMonthlyReport();
            $countAttendances = $monthlyReport['countAttendances'];
//            dd($countAttendances);
            $netSalaries = $monthlyReport['netSalaries'];
//            var_dump($employee);
//            $attendance = $countAttendances->where('employee_name', $employee->name)->first();
            if (!$countAttendances) {
                return $this->error("Employee not found", Response::HTTP_NOT_FOUND);
            }
//            dd($countAttendances);

//            $data = [
//                'employee_name' => $countAttendances->employee_name,
//                'attendance_month' => $countAttendances->attendance_month,
//                'total_attendance' => $countAttendances->total_attendance,
//                'loan_amount' => $countAttendances->loan_amount,
//                'repayment_period' => $countAttendances->repayment_period,
//                'repayment_start_date' => $countAttendances->repayment_start_date,
//                'net_salary' => $netSalaries[$countAttendances->employee_name][$countAttendances->attendance_month] ?? 0 // Default to 0 if not found
//            ];

            return $this->success(new MonthlyReportResourceCollection($countAttendances), "Employee retrieved successfully", Response::HTTP_OK);

        } catch (\Exception $e) {
            return $this->error("Unable to retrieve employee data: " . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }



}
