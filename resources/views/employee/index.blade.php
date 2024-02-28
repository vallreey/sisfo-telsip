<!-- resources/views/employee/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Employee List</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">Add Employee</a>

        @if(session('success'))
            <div id="employee-added" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Action</th>
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
                        <td>
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>

                            <!-- Tombol Delete dengan SweetAlert -->
                            <button class="btn btn-danger" onclick="confirmDelete('{{ $employee->id }}')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript untuk SweetAlert dan Axios -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function confirmDelete(employeeId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim permintaan DELETE dengan Axios
                    axios.delete(`/employees/${employeeId}`)
                        .then((response) => {
                            if (response.data.success) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Employee has been deleted.',
                                    icon: 'success'
                                });

                                // Redirect atau perbarui halaman setelah penghapusan berhasil
                                location.reload();
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to delete employee.',
                                    icon: 'error'
                                });
                            }
                        })
                        .catch((error) => {
                            console.error(error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting employee.',
                                icon: 'error'
                            });
                        });
                }
            });
        }

        // Warna pop-up "employee deleted successfully" menjadi merah
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                document.getElementById('employee-added').style.display = 'none';
            }, 5000);
        });
    </script>
@endsection
