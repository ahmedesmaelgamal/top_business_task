<?php

namespace App\Services;


use Carbon\Carbon;
use Cron\DayOfMonthField;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
    public function getMonthlyReport()
    {
        $countAttendances = DB::table('employees as e')
            ->leftJoin('attendances as a', 'e.id', '=', 'a.employee_id')
            ->leftJoin('loans as l', function ($join) {
                $join->on('e.id', '=', 'l.employee_id')
                    ->whereRaw('MONTH(l.start_date) = MONTH(a.date)')
                    ->whereRaw('YEAR(l.start_date) = YEAR(a.date)');
            })
            ->select(
                'e.name as employee_name',
                DB::raw('MONTH(a.date) as attendance_month'),
                DB::raw('YEAR(a.date) as attendance_year'),
                DB::raw('COALESCE(l.amount, 0) as loan_amount'),
                'l.repayment_period',
                'l.start_date as repayment_start_date',
                'e.salary as base_salary',
                DB::raw('COUNT(DISTINCT a.id) as total_attendance')
            )
            ->groupBy('e.id', 'e.name', DB::raw('YEAR(a.date)'), DB::raw('MONTH(a.date)'), 'l.amount', 'l.repayment_period', 'l.start_date', 'e.salary')
            ->orderBy('e.name')
            ->orderBy(DB::raw('YEAR(a.date)'))
            ->orderBy(DB::raw('MONTH(a.date)'))
            ->orderBy('repayment_start_date')
            ->get();
//        $month = [][];
        $net_salaries = []; // Array to store net salaries for each employee by month
        $repayment_period = []; // Array to store remaining repayment periods

        foreach ($countAttendances as $countAttendance) {
            $employee_name = $countAttendance->employee_name;
            $attendance_month = $countAttendance->attendance_month;
            $base_salary = $countAttendance->base_salary;

            // Initialize arrays if not already set
            if (!isset($net_salaries[$employee_name])) {
                $net_salaries[$employee_name] = [];
            }
            if (!isset($repayment_period[$employee_name])) {
                $repayment_period[$employee_name] = [];
            }

            // Initialize repayment period if not set
            if (!isset($repayment_period[$employee_name][$attendance_month])) {
                $repayment_period[$employee_name][$attendance_month] =
                    $countAttendance->repayment_period ?? 0;
            }

            // Calculate monthly repayment
            $monthly_repayment = 0;
            if ($countAttendance->loan_amount > 0 && $countAttendance->repayment_period > 0) {
                $monthly_repayment = $countAttendance->loan_amount / $countAttendance->repayment_period;
            }

            // Get minimum date (repayment start date)
            $min_date = Carbon::parse($countAttendances->pluck('repayment_start_date')->min())->day;
            $previous_month = $attendance_month - 1;

            // Calculate net salary using base salary as default
            $net_salary = $base_salary;

            if ($attendance_month > $min_date) {
                $previous_net_salary = $net_salaries[$employee_name][$previous_month] ?? $base_salary;

                // Only deduct repayment if there are remaining periods
                if (isset($repayment_period[$employee_name][$previous_month]) &&
                    $repayment_period[$employee_name][$previous_month] > 0) {
                    $net_salary = $previous_net_salary - $monthly_repayment;
                }
            }

            // Store the calculated net salary
            $net_salaries[$employee_name][$attendance_month] = $net_salary;
            $net_salaries[$employee_name][$min_date] = $base_salary;

            // Decrement repayment period only if it's set and greater than 0
            if (isset($repayment_period[$employee_name][$attendance_month]) &&
                $repayment_period[$employee_name][$attendance_month] > 0) {
                $repayment_period[$employee_name][$attendance_month]--;
            }

            // Add the calculated net salary to the current attendance object
            $countAttendance->net_salary = $net_salary;
        }

// Now return the modified countAttendances array with net salary included
        return [
            'countAttendances' => $countAttendances,
            'netSalaries' => $net_salaries,
        ];
    }
}