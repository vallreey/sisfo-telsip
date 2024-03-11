<!-- resources/views/layouts/partials/navbar.blade.php -->

<nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Add your navbar links here -->
        <li class="nav-item">
            <!-- Tombol untuk menampilkan modal -->
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal"><span>Logout</span></a>
        </li>
    </ul>
</nav>

<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan Logout?</p>
            </div>
            <div class="modal-footer">
                <!-- Tombol Logout -->
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Ya</button>
                </form>
                <!-- Tombol Batal -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <!-- Pesan "Berhasil Logout" -->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
