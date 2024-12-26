<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanDeduction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::factory()->count(10)->create();
        foreach ($employees as $employee) {
            $this->generateAttendance($employee);
            $this->generateLoans($employee);
        }

    }

    public function generateAttendance($employee)
    {
        //the attendance period is the last 4 months ex: if we are in october the startDate will be the first of june and the endDate with be the last day in september
        $startDate = Carbon::now()->subMonths(4)->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();

        $period = CarbonPeriod::create($startDate, $endDate);

        $workdays = [];

        foreach ($period as $date) {
            if (!$date->isFriday()) {
                $workdays[] = $date->format('Y-m-d');
            }
        }

        $selectedDays = collect($workdays)->random(100)->sort()->values();//Attendance days

        foreach ($selectedDays as $date) {
            $checkIn = Carbon::parse($date . ' 09:00:00')->addMinutes(rand(0, 60));
            $checkOut = Carbon::parse($date . ' 17:00:00')->addMinutes(rand(0, 60));
            $workTimeDiff = $checkOut->diffInHours($checkIn, true);

            Attendance::create([
                'employee_id' => $employee->id,
                'date' => $date,
                'check_in' => $checkIn->format('H:i:s'),
                'check_out' => $checkOut->format('H:i:s'),
                'work_time_diff' => $workTimeDiff
            ]);
        }

    }

    public function generateLoans($employee)
    {
        $loanConfigs = [
            ['amount' => 5000, 'repayment_period' => 2],
            ['amount' => 8000, 'repayment_period' => 3],
            ['amount' => 3000,'repayment_period' => 4],
            ['amount' => 10000, 'repayment_period' => 2],
            ['amount' => 2000, 'repayment_period' => 3],
        ];

        foreach ($loanConfigs as $index => $config) {
            $randomDays = rand(1, 120);
            $startDate = Carbon::now()->startOfMonth()->subDays($randomDays);

            $loan = Loan::create([
                'employee_id' => $employee->id,
                'amount' => $config['amount'],
                'repayment_period' => $config['repayment_period'],
                'start_date' => $startDate,
                'status' => 'active'
            ]);


            $monthlyDeduction = $config['amount'] / $config['repayment_period'];


            // Calculate how many months since the loan start date
            $monthsSinceLoanStart = Carbon::parse($loan->start_date)->diffInMonths(Carbon::now());

            for ($month = 0; $month < $config['repayment_period']; $month++) {
                $deductionDate = Carbon::parse($loan->start_date)->addMonths($month);

                $remainingAmount = $config['amount'] - ($monthlyDeduction * ($month + 1));

                $status = 'pending';
                if ($month < $monthsSinceLoanStart) {
                    $status = 'paid';
                } elseif ($month == $monthsSinceLoanStart) {
                    $status = 'due';
                }

                LoanDeduction::create([
                    'loan_id' => $loan->id,
                    'deduction_date' => $deductionDate,
                    'deduction_amount' => $monthlyDeduction,
                    'remaining_amount' => max(0, $remainingAmount), // Ensure it never goes below 0
                    'status' => $status
                ]);
            }
        }
    }
}
