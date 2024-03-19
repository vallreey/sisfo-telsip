<!-- resources/views/user/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Employee List</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->birthdate }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->phone_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
