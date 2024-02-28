<!-- resources/views/attendance/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Presences</h1>

        @if($presences->isEmpty())
            <p>No records found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($presences as $presence)
                        <tr>
                            <td>{{ $presence->user->name }}</td>
                            <td>{{ $presence->attendance_date }}</td>
                            <td>{{ ucfirst($presence->shift) }}</td>
                            <td>{{ ucfirst($presence->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
