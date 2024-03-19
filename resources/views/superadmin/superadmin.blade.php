@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid" style="margin-top: 25px;">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <div style="color: #3D3D3D; font-size: 36px; font-family: Poppins; font-weight: 500; margin-left: -240px; margin-top: -5px;">Dashboard</div>
                    </div><!-- /.col -->
                    <div class="col-sm-6" style="right:40px">
                        <ol class="breadcrumb float-sm-right">
                            <li><span id="currentDate"></span></li>
                        </ol>
                    </div>
                    
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div style="display: flex;">
            <div style="width: 329px; height: 169px; position: relative; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); margin-left: -220px">
                <div style="width: 329px; height: 147px; left: 0px; top: 22px; position: absolute; background: white; border-radius: 5px"></div>
                <div style="left: 186px; top: 30px; position: absolute; text-align: right; color: #8F8F8F; font-size: 14px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Jumlah Karyawan</div>
                <div style="left: 231px; top: 45px; position: absolute; text-align: right; color: #8F8F8F; font-size: 36px; font-family: Poppins; font-weight: 500; word-wrap: break-word"><p>{{ $totalEmployees }}</p></div>
                <div style="width: 289px; height: 0px; left: 24px; top: 136px; position: absolute; border: 1px #E0E0E0 solid"></div>
                <div style="width: 91px; height: 91px; left: 25px; top: 0px; position: absolute">
                  <div style="width: 91px; height: 91px; left: 0px; top: 0px; position: absolute; background: #3385FF; box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.25); border-radius: 5px"></div>
                  <img style="width: 36px; height: 35px; left: 31px; top: 28px; position: absolute" src="assets/karyawan.png" />
                </div>
                <div style="left: 42px; top: 145px; position: absolute; color: #00A811; font-size: 10px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Status Aktif</div>
                <img style="width: 11px; height: 11px; left: 25px; top: 147px; position: absolute" src="assets/Approved.png" />
              </div>
        </div>
        <!-- Main content -->
        
        <!-- /.content -->

        <div style="display: flex;">
        <section style="margin-top: 55px; margin-left: -290px">
            <div style="width: 477px; height: 180px; position: relative; margin-left:67px;">
                <div style="width: 477px; height: 156px; left: 0px; top: 24px; position: absolute; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); background: white"></div>
                <div style="width: 456.65px; height: 74px; left: 10.55px; top: 0px; position: absolute; background: linear-gradient(90deg, #40B45A 0%, #20B249 100%)"></div>
                <div style="width: 262px; left: 23px; top: 12px; position: absolute; color: white; font-size: 16px; font-family: Poppins; font-weight: 700; word-wrap: break-word">Absensi Karyawan Hari ini</div>
                <div style="width: 208px; left: 23px; top: 42px; position: absolute; color: white; font-size: 14px; font-family: Poppins; font-style: italic; font-weight: 400; word-wrap: break-word" id="tanggal"></div>

                <div style="width: 28px; left: 285px; top: 84px; position: absolute; color: #1A8BBC; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Izin</div>
                <div style="width: 44px; left: 167px; top: 84px; position: absolute; color: #CCCF26; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Sakit</div>
                <div style="width: 52px; left: 41px; top: 84px; position: absolute; color: #22B715; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Hadir</div>
                <div style="width: 48px; left: 387px; top: 84px; position: absolute; color: #FF0000; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">Cuti</div>
                <div style="width: 36px; left: 47px; top: 122px; position: absolute; color: #444141; font-size: 25px; font-family: Poppins; font-weight: 400; word-wrap: break-word"><p>{{ $totalPresent }}</p></div>
                <div style="width: 32px; left: 173px; top: 122px; position: absolute; color: #444141; font-size: 25px; font-family: Poppins; font-weight: 400; word-wrap: break-word"><p>{{ $totalSick }}</p></div>
                <div style="width: 26px; left: 286px; top: 122px; position: absolute; color: #444141; font-size: 25px; font-family: Poppins; font-weight: 400; word-wrap: break-word"><p>{{ $totalPermission }}</p></div>
                <div style="width: 33px; left: 395px; top: 122px; position: absolute; color: #444141; font-size: 25px; font-family: Poppins; font-weight: 400; word-wrap: break-word"><p>{{ $totalCuti }}</p></div>
              </div>
              
        </section>
        </div>
        
    </div>
    <div>
    </div>
    <div class="container">
        <h2>Financial Overview</h2>

        <canvas id="financialChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('financialChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March'],
                    datasets: [{
                        label: 'Financial Data',
                        data: [{{$totalCuti}}], // Contoh data keuangan
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    return 'Rp' + value.toLocaleString(); // Format uang
                                }
                            }
                        }]
                    }
                }
            });
        });
    </script>
    

    <!-- /.js nya ini -->
    <!-- /.js nya ini -->
<script>
    // Mendapatkan elemen span untuk menampilkan tanggal
    var currentDateElement = document.getElementById('currentDate');

    // Fungsi untuk mengupdate tanggal setiap detik
    function updateCurrentDate() {
        var currentDate = new Date();
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        var formattedDate = dayNames[currentDate.getDay()] + ', ' +
                            currentDate.getDate() + ' ' +
                            monthNames[currentDate.getMonth()] + ' ' +
                            currentDate.getFullYear();
        currentDateElement.textContent = formattedDate;
    }

    // Memanggil fungsi pertama kali saat halaman dimuat
    updateCurrentDate();

    // Memanggil fungsi untuk mengupdate tanggal setiap detik (1000 milidetik)
    setInterval(updateCurrentDate, 1000);
</script>

<script>
    // Mendapatkan tanggal saat ini
    var currentDate = new Date();
  
    // Mendapatkan elemen dengan ID "tanggal"
    var currentDateElement = document.getElementById('tanggal');
  
    // Menetapkan tanggal saat ini ke dalam elemen HTML
    function updateCurrentDate() {
        var currentDate = new Date();
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        var formattedDate = dayNames[currentDate.getDay()] + ', ' +
                            currentDate.getDate() + ' ' +
                            monthNames[currentDate.getMonth()] + ' ' +
                            currentDate.getFullYear();
        currentDateElement.textContent = formattedDate;
    }

    // Memanggil fungsi pertama kali saat halaman dimuat
    updateCurrentDate();

    // Memanggil fungsi untuk mengupdate tanggal setiap detik (1000 milidetik)
    setInterval(updateCurrentDate, 1000);
  </script>
  

    
    
@endsection
