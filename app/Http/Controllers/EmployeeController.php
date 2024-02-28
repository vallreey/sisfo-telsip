<?php

namespace App\Http\Controllers;

// app/Http/Controllers/EmployeeController.php

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }
    public function show($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return view('employee.show', compact('employee'));
        }

        return redirect()->route('employees.index')->with('error', 'Employee not found.');
    }
    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
