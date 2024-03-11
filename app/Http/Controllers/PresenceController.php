<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index()
    {
        $presences = Presence::with('user')->get();
        return view('attendance.index', compact('presences'));
    }

    public function create()
    {
        return view('attendance.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shift' => 'required|in:morning,afternoon,evening',
            'status' => 'required|in:present,permission,sick,cuti',
        ]);

        $existingPresence = Presence::where([
            'user_id' => Auth::id(),
            'attendance_date' => now()->toDateString(),
            'shift' => $request->input('shift'),
        ])->first();

        if ($existingPresence) {
            return redirect()->route('attendance.create')->with('error', 'Kamu sudah membuat presensi untuk sesi ini.');
        }

        Presence::create([
            'user_id' => Auth::id(),
            'attendance_date' => now()->toDateString(),
            'shift' => $request->input('shift'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully.');
    }

    public function edit(Presence $presence)
    {
        // Your edit logic here
    }

    public function update(Request $request, Presence $presence)
    {
        // Your update logic here
    }

    public function destroy(Presence $presence)
    {
        // Your delete logic here
    }
}