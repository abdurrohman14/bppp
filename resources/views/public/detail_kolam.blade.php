<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kolam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Detail Kolam</h3>
            </div>
            <div class="card-body">
                <h4 class="card-title">{{ $kolam->nama }}</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Budidaya:</strong> {{ $kolam->budaya }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $kolam->status }}</li>
                    <li class="list-group-item"><strong>Diameter:</strong> {{ $kolam->ukuran_kolam }}</li>
                    <li class="list-group-item"><strong>Jumlah Ikan:</strong> {{ $kolam->jumlah_ikan }}</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

