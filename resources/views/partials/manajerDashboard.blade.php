<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Manajemen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #f8f9fa;
            position: fixed;
            padding: 20px;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .card {
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-3">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="assets/images/bppp_logo.png" alt="Logo BPPP Banyuwangi" height="50" class="me-2">
            <span class="fw-bold text-white">BPPP BANYUWANGI</span>
        </a>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-water"></i> Manajemen Kolam</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-fish"></i> Manajemen Spesies</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-seedling"></i> Penebaran Benih</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-skull-crossbones"></i> Manajemen Mortalitas</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-tint"></i> Kualitas Air</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-clipboard-list"></i> Manajemen Panen</a></li>
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="fas fa-utensils"></i> Manajemen Pakan</a>
                <ul class="nav flex-column ms-3">
                    <li><a class="nav-link" href="#">Pakan Keluar</a></li>
                    <li><a class="nav-link" href="#">Pakan Masuk</a></li>
                    <li><a class="nav-link" href="#">Restok Pakan</a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-plus"></i> Tambah Role</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-file-alt"></i> Laporan</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <h5>Jumlah Kolam</h5>
                    <h2>100</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <h5>Total Hasil Panen</h5>
                    <h2>100</h2>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card shadow-sm p-3">
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [
                    {
                        label: 'Suhu',
                        data: [30, 32, 31, 33, 35, 36, 37],
                        borderColor: 'blue',
                        fill: false
                    },
                    {
                        label: 'pH',
                        data: [7.1, 7.3, 7.2, 7.4, 7.5, 7.6, 7.7],
                        borderColor: 'green',
                        fill: false
                    },
                    {
                        label: 'Oksigen',
                        data: [6.0, 6.2, 6.1, 6.3, 6.4, 6.5, 6.6],
                        borderColor: 'red',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>