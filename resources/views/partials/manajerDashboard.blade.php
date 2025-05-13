@extends('partials.admin.main')
@section('content')
    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 content">
        <h3>Dashboard</h3>
        <div class="card shadow border-0" style="min-height: 500px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card text-white bg-info shadow border-0">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Kolam</h5>
                                <h2>100</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card text-white bg-success shadow border-0">
                            <div class="card-body">
                                <h5 class="card-title">Total Hasil Panen</h5>
                                <h2>100</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart -->
                <div class="card border-0" style="min-height: 500px;">
                    <div class="card-body">
                        <canvas id="myChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
