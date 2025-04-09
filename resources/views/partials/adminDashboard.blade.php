@extends('partials.admin.main')
@section('content')
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
@endsection