<!-- resources/views/layouts/partials/sidebar.blade.php -->

<link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
<aside class="main-sidebar sidebar-light-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <button type="button" class="btn btn-light" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <img src="{{ asset('assets/logo-telsip.png') }}" alt="Logo" style="max-width: 150px; max-height: 150px; margin-left: 10px;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-details">
            <img src="assets\avatar.png" alt="User Photo" class="user-avatar"> <br>
            <span class="user-name">{{ auth()->user()->name }}</span>
        </div>
        <!-- Add your sidebar content here -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="nav-icon fas fa-home"></i> Dashboard
                    </a>
                </li>
                
                <!-- Menampilkan item sidebar Employees hanya untuk role superadmin -->
                @if(auth()->user()->role === 'superadmin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}">
                        <i class="nav-icon fas fa-users"></i> Employees
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('attendance.create') }}">
                        <i class="nav-icon fas fa-clock"></i> Attendance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}">
                        <i class="nav-icon fas fa-tasks"></i> Daily Task
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}">
                        <i class="nav-icon fas fa-cookie"></i> Salary
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}">
                        <i class="nav-icon fas fa-cog"></i> Settings
                    </a>
                </li>
                <!-- Add more sidebar items here -->
            </ul>
        </nav>
    </div>
</aside>

<!-- ... (script sebelumnya) ... -->

<script>
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
    });
</script>
