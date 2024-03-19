<!-- resources/views/employee/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Employee</h2>

        <form action="{{ route('employees.update', $employee->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
            </div>
            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $employee->birthdate }}" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ $employee->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $employee->phone_number }}" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>
    </div>
@endsection
