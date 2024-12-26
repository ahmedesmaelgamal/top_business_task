@extends('layout.app')

@section('content')
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <div class="right_content">
                    <h5 class="modal-title">Employee Details</h5>
                </div>

            </div>

            <div class="modal-body ">
                <div class="col-md-12 mb-3">
                    <table class="table table-hover text-center border" id="my-table">
                        <thead>
                        <tr>
                            <th class="w-1">Employee Name</th>
                            <th>Month</th>
                            <th>Total Attendance</th>
                            <th>Loan amount in this month</th>
                            <th>Repayment period</th>
                            <th>Repayment start date</th>
                            <th>Base salary</th>
                            <th>Net salary</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($countAttendances as $countAttendance)
                            <tr>
                                <td>{{ $countAttendance->employee_name }}</td>
                                <td>{{ $countAttendance->attendance_month }}</td>
                                <td>{{ $countAttendance->total_attendance }}</td>
                                <td>{{ $countAttendance->loan_amount }}</td>
                                <td>{{ $countAttendance->repayment_period }}</td>
                                <td>{{ $countAttendance->repayment_start_date }}</td>
                                <td>{{ $countAttendance->base_salary }}</td>
                                <td>{{ $netSalaries[$countAttendance->employee_name][$countAttendance->attendance_month] }}</td>
{{--                                <td>{{ $countAttendance->total_attendance }}</td>--}}
{{--                                <td>{{ $countAttendance->total_attendance }}</td>--}}

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-8 mb-3">
                    <table class="table table-hover text-center border" id="my-table">
                        <thead>
                        <tr>
                            <th class="w-1">ID</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Work Time Diff</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($employee->attendance as $attendance)
                            <tr>
                                <td>{{ $attendance->id }}</td>
                                <td>{{ $attendance->date }}</td>
                                <td>{{ $attendance->check_in }}</td>
                                <td>{{ $attendance->check_out }}</td>
                                <td>{{ $attendance->work_time_diff }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
@endsection
