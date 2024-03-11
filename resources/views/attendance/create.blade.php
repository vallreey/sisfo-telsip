@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Record Attendance</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="post" action="{{ route('attendance.store') }}">
            @csrf
            <div class="form-group">
                <label for="shift">Shift:</label>
                <select name="shift" id="shift" class="form-control">
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="present">Hadir</option>
                    <option value="permission">Izin</option>
                    <option value="sick">Sakit</option>
                    <option value="leave">Cuti</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Record Attendance</button>
            <!-- Button "Lihat Absensi" -->
            <a href="/attendance" class="btn btn-success">Lihat Absensi</a>
        </form>
    </div>
@endsection
