<!-- resources/views/employee/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Employee Details</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <td>{{ $employee->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $employee->name }}</td>
            </tr>
            <tr>
                <th>Birthdate</th>
                <td>{{ $employee->birthdate }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $employee->address }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $employee->phone_number }}</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                    @if($employee->image_path)
                        <img src="{{ asset($employee->image_path) }}" alt="Employee Photo" style="max-width: 200px; max-height: 200px;">
                    @else
                        No Photo
                    @endif
                </td>
            </tr>
        </table>
        <a href="{{ route('employees.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
