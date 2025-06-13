<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
</head>

<body>
    @include('partials.admin.navbar')

    <div class="container-fluid mt-4">
        <div class="row">
            @include('partials.admin.sidebar')

            @yield('content')
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Chart
        // const ctx = document.getElementById("myChart");
        // new Chart(ctx, {
        //     type: "line",
        //     data: {
        //         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        //         datasets: [{
        //                 label: "Suhu",
        //                 borderColor: "blue",
        //                 data: [30, 32, 31, 33, 35, 36],
        //             },
        //             {
        //                 label: "pH",
        //                 borderColor: "green",
        //                 data: [7.2, 7.4, 7.3, 7.5, 7.6, 7.7],
        //             },
        //             {
        //                 label: "Oksigen",
        //                 borderColor: "red",
        //                 data: [6.8, 7, 6.9, 7.1, 7.2, 7.3],
        //             },
        //         ],
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //     },
        // });
        // Sidebar toggle
        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener("click", function() {
            sidebar.classList.toggle("show");
        });
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                });
            @endif
        });
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
        $(function() {
            // Summernote
            $('#summernote').summernote()
        })
    </script>
    @stack('scripts')
</body>
</html>
