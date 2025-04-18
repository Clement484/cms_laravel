<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>


    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/sass/app.scss'])

    @yield('styles')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            @include('partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                    @include('partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    {{-- <h1 class="h3 mb-4 text-gray-800">Dashboard</h1> --}}

                    <!-- Content goes here -->
                    @yield('content')

                    
                    @if(session('success'))
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
                        <div class="toast align-items-center text-white bg-success border-0 show" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; My CMS 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // SEARCH
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#customTable tbody tr');
            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                row.style.display = name.includes(filter) ? '' : 'none';
            });
        });

        // SORT
        function sortTable(colIndex) {
            const table = document.getElementById('customTable');
            let switching = true, shouldSwitch, i, x, y, dir = 'asc', switchcount = 0;

            while (switching) {
                switching = false;
                const rows = table.rows;

                for (i = 1; i < rows.length - 1; i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName('TD')[colIndex];
                    y = rows[i + 1].getElementsByTagName('TD')[colIndex];

                    if ((dir === 'asc' && x.innerHTML > y.innerHTML) || (dir === 'desc' && x.innerHTML < y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount === 0 && dir === 'asc') {
                        dir = 'desc';
                        switching = true;
                    }
                }
            }
        }


        // TOAST
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('successToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000
                });
                toast.show();
            }
        });

        // Remove flash message on back navigation
            window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            const toastEl = document.getElementById('successToast');
            if (toastEl) {
                toastEl.remove(); // or toastEl.style.display = 'none';
            }
        }
        });



    </script>
@yield('scripts')
</body>

</html>