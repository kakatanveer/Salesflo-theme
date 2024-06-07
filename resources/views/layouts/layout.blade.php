<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>@yield('title', 'Default Title')</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <!-- End Dashboard Nav -->
                <li class="nav-item">

                    <a class="nav-link" href="{{ route('ShowItems') }}">

                        <i class="bi bi-grid"></i>
                        <span>Items</span>
                    </a>
                </li>

                <!-- End Customer Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('ShowCustomers') }}">
                        <i class="bi bi-grid"></i>
                        <span>Customers</span>
                    </a>
                </li>

                <!-- End Credit Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('ShowCredit')}}">
                        <i class="bi bi-grid"></i>
                        <span>Credit</span>
                    </a>
                </li>

                <!-- End Expense Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('ShowExpense')}}" >
                        <i class="bi bi-grid"></i>
                        <span>Expense</span>
                    </a>
                </li>

                <!-- End Sellings Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span>Sell</span>
                    </a>
                </li>

                <!-- End Reports Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Chart.js</span>
                        </a>
                    </li>
                    <li>
                        <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>ApexCharts</span>
                        </a>
                    </li>
                    <li>
                        <a href="charts-echarts.html">
                        <i class="bi bi-circle"></i><span>ECharts</span>
                        </a>
                    </li>
                    </ul>
                </li><!-- End Charts Nav -->
            </ul>
        </aside><!-- End Sidebar-->

        <main id="main" class="main">
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">

                            <!-- ======= Header ======= -->
                            <header id="header" class="header fixed-top d-flex align-items-center">

                                <div class="d-flex align-items-center justify-content-between">
                                <a href="index.html" class="logo d-flex align-items-center">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block"> AGS Battries </span>
                                </a>
                                <i class="bi bi-list toggle-sidebar-btn"></i>
                                </div><!-- End Logo -->

                            </header><!-- End Header -->



                            @yield("content")


                            <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->
                    </div>
                </div>
            </section>
        </main>


            <!-- Vendor JS Files -->
            <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
            <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
            <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
            <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

            <!-- Template Main JS File -->
            <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>
