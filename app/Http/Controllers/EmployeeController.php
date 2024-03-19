<?php

namespace App\Http\Controllers;

// app/Http/Controllers/EmployeeController.php

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Tangkap file gambar yang diunggah
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');

            // Berikan nama unik untuk file gambar
            $imageName = time().'.'.$image->extension();

            // Pindahkan file gambar ke direktori yang telah ditentukan
            $image->move(public_path('uploads'), $imageName);

            // Simpan jalur file gambar ke dalam kolom 'image_path'
            $imagePath = 'uploads/'.$imageName;
        } else {
            $imagePath = null;
        }

        // Membuat karyawan baru
        $employee = new Employee([
            'name' => $request->get('name'),
            'birthdate' => $request->get('birthdate'),
            'address' => $request->get('address'),
            'phone_number' => $request->get('phone_number'),
            'image_path' => $imagePath, // Menyimpan jalur gambar ke dalam kolom image_path
        ]);

        $employee->save();

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
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Tangkap file gambar yang diunggah
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');

            // Berikan nama unik untuk file gambar
            $imageName = time().'.'.$image->extension();

            // Pindahkan file gambar ke direktori yang telah ditentukan
            $image->move(public_path('uploads'), $imageName);

            // Simpan jalur file gambar ke dalam kolom 'image_path'
            $imagePath = 'uploads/'.$imageName;

            // Update jalur gambar baru dalam database
            $employee->image_path = $imagePath;
        }

        // Update informasi karyawan
        $employee->name = $request->get('name');
        $employee->birthdate = $request->get('birthdate');
        $employee->address = $request->get('address');
        $employee->phone_number = $request->get('phone_number');
        $employee->save();

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
