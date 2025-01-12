@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Employees with the {{ $n }}-th Highest Salary</h1>

        @if ($nthSalary === null)
            <div class="alert alert-warning">
                No employees found for the {{ $n }}-th highest salary.
            </div>
        @else
            <div class="alert alert-info">
                Showing employees with the {{ $n }}-th highest salary: <strong>${{ number_format($nthSalary, 2) }}</strong>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Highest Salary</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>${{ number_format($nthSalary, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No employees found for this salary range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif

        <div class="mt-4 mb-4">
            <form method="GET" action="{{ route('employees.index') }}">
                <div class="form-group">
                    <label for="n">Enter the N-th Highest Salary to View Employees:</label>
                    <input type="number" id="n" name="n" class="form-control" min="1" value="{{ $n }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Filter Employees</button>
            </form>
        </div>
    </div>
@endsection
