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

        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

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
                        <span> Members </span>
                    </a>
                </li>

                <!-- End Sellings Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span>Project </span>
                    </a>
                </li>

                <!-- End Sellings Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span>Donation </span>
                    </a>
                </li>

                <!-- End Sellings Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span>Investment  </span>
                    </a>
                </li>

                 <!-- End Sellings Nav -->
                 <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span> Current Balance </span>
                    </a>
                </li>

                <!-- End Sellings Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span> Func Collection </span>
                    </a>
                </li>

                <!-- End Sellings Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span> Expence Type </span>
                    </a>
                </li>

                 <!-- End Sellings Nav -->
                 <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span> Category  Type </span>
                    </a>
                </li>

                 <!-- End Sellings Nav -->
                 <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span> Patent Expense </span>
                    </a>
                </li>


                <!-- End Sellings Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span> Child Expense </span>
                    </a>
                </li>

                <!-- End Sellings Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('sells.index')}}">
                        <i class="bi bi-grid"></i>
                        <span> Activity </span>
                    </a>
                </li>

                <!-- End Credit Nav -->
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('AddCredit')}}">
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



                <!-- End Reports Nav -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('generate-stock-report') }}" id="availableStockLink">
                            <i class="bi bi-circle"></i><span> Available Stock </span>
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
                                    <span class="d-none d-lg-block"> Committee System </span>
                                </a>
                                <i class="bi bi-list toggle-sidebar-btn"></i>

                                <nav class="header-nav ms-auto">
                                    <ul class="d-flex align-items-center">

                                      <li class="nav-item dropdown pe-3">

                                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                                          <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                                          <span class="d-none d-md-block dropdown-toggle ps-2"> User </span>
                                        </a><!-- End Profile Iamge Icon -->

                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                          <li class="dropdown-header">
                                            <h6> User </h6>
                                            <span> User </span>
                                          </li>
                                          <li>
                                            <hr class="dropdown-divider">
                                          </li>

                                          <li>
                                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                              <i class="bi bi-person"></i>
                                              <span>My Profile</span>
                                            </a>
                                          </li>
                                          <li>
                                            <hr class="dropdown-divider">
                                          </li>

                                          <li>
                                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                              <i class="bi bi-gear"></i>
                                              <span>Account Settings</span>
                                            </a>
                                          </li>
                                          <li>
                                            <hr class="dropdown-divider">
                                          </li>

                                          <li>
                                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                              <i class="bi bi-question-circle"></i>
                                              <span>Need Help?</span>
                                            </a>
                                          </li>
                                          <li>
                                            <hr class="dropdown-divider">
                                          </li>

                                          <li>
                                            <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                                              <i class="bi bi-box-arrow-right"></i>
                                              <span>Sign Out</span>
                                            </a>
                                          </li>

                                        </ul><!-- End Profile Dropdown Items -->
                                      </li><!-- End Profile Nav -->

                                    </ul>
                                  </nav><!-- End Icons Navigation -->
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
