@extends('admin.layouts.app')

@section('content')
    <h1>Departments</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Salary</th>
                <th>Employees</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->salary->amount }}</td>
                    <td>{{ $department->users->pluck('name')->join(', ') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
