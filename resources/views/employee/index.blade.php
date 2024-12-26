@extends('layout.app')
@section('content')
    <table class="table  table-hover  text-center border"
           id="employee-table">
        <thead>
        <tr>

            <th class="w-1">ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Salary</th>
            <th>Acitons</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>
                    {{$employee->id}}
                </td>
                <td>
                    {{$employee->name}}
                </td>
                <td>
                    {{$employee->email}}
                </td>
                <td>
                    {{$employee->salary}}
                </td>
                <td>
                    <a class="btn btn-outline-primary" href="{{route('employee.show',$employee->id)}}">View</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
