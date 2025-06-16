<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - BPPP Banyuwangi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Sanista+One&family=Sedan+SC&family=Roboto:wght@700&display=swap" rel="stylesheet">

  <style>
    body {
      background-image: url('{{ asset('assets/img/SFV.jpg') }}'); /* Ganti dengan nama file gambarmu */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

        .login-card {
      background-color: #006edb; /* Warna biru solid */
      border-radius: 12px;
      padding: 40px 30px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .login-card img {
      width: 100px;
      margin-bottom: 20px;
    }

    .smart-title {
      font-family: 'Sedan SC', serif;
      color: white;
    }

    .bppp-title {
      font-family: 'Sanista One', cursive;
      color: white;
    }

    .form-control::placeholder {
      color: #999;
    }

    .form-icon {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      color: #000000;
      font-size: 1.1rem;
      z-index: 3;
    }

    .form-control {
      padding-left: 45px !important;
      background-color: #ffffff !important;
      border: 1px solid #ffffff;
      font-weight: bold;
    }

    .btn-dark {
      background-color: #f0f0f0;
      color: #000;
      border: none;
      font-family: 'Roboto', sans-serif;
      font-weight: 700;
    }

    .btn-dark:hover {
      background-color: #f0f0f0;
      color: #000;
    }
  </style>
</head>
<body>

<div class="login-card">
  <img src="{{ asset('assets/img/logo.png') }}" alt="Logo KKP" class="img-fluid" style="width:150px;">
  <h6 class="text-uppercase smart-title">Smart Fisheries Village</h6>
  <h5 class="fw-bold mb-4 bppp-title">Balai Pelatihan dan Penyuluhan Perikanan (BPPP) Banyuwangi</h5>

  <form action="{{ route('login') }}" method="post">
    @csrf
    <div class="mb-3 position-relative">
      <span class="form-icon"><i class="bi bi-envelope-fill"></i></span>
      <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
    </div>
    <div class="mb-4 position-relative">
      <span class="form-icon"><i class="bi bi-lock-fill"></i></span>
      <input type="password" class="form-control" name="password" required placeholder="Password">
    </div>
    <button type="submit" class="btn btn-dark shadow-sm px-5 py-2 d-block mx-auto">LOGIN</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
