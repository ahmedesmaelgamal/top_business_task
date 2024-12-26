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
        $net_salaries = [];
        $repayment_period = [];

        foreach ($countAttendances as $countAttendance) {
            $employee_name = $countAttendance->employee_name;
            $attendance_month = $countAttendance->attendance_month;
            $base_salary = $countAttendance->base_salary;

            if (!isset($net_salaries[$employee_name])) {
                $net_salaries[$employee_name] = [];
            }
            if (!isset($repayment_period[$employee_name])) {
                $repayment_period[$employee_name] = [];
            }

            if (!isset($repayment_period[$employee_name][$attendance_month])) {
                $repayment_period[$employee_name][$attendance_month] =
                    $countAttendance->repayment_period ?? 0;
            }

            $monthly_repayment = 0;
            if ($countAttendance->loan_amount > 0 && $countAttendance->repayment_period > 0) {
                $monthly_repayment = $countAttendance->loan_amount / $countAttendance->repayment_period;
            }

            $min_date = Carbon::parse($countAttendances->pluck('repayment_start_date')->min())->day;
            $previous_month = $attendance_month - 1;

            $net_salary = $base_salary;

            if ($attendance_month > $min_date) {
                $previous_net_salary = $net_salaries[$employee_name][$previous_month] ?? $base_salary;
                if (isset($repayment_period[$employee_name][$previous_month]) &&
                    $repayment_period[$employee_name][$previous_month] > 0) {
                    $net_salary = $previous_net_salary - $monthly_repayment;
                }
            }

            $net_salaries[$employee_name][$attendance_month] = $net_salary;
            $net_salaries[$employee_name][$min_date] = $base_salary;

            if (isset($repayment_period[$employee_name][$attendance_month]) &&
                $repayment_period[$employee_name][$attendance_month] > 0) {
                $repayment_period[$employee_name][$attendance_month]--;
            }

            $countAttendance->net_salary = $net_salary;
        }

        return [
            'countAttendances' => $countAttendances,
            'netSalaries' => $net_salaries,
        ];
    }
}
