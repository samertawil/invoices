<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>@yield('title', env('APP_NAME'))</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('css/invoice_style.css') }}" rel="stylesheet">

    <style>
        #accordionSidebar {
            direction: ltr;

            background-color: #212529 !important;
        }

        #nav1 {

            display: block !important;
            direction: ltr;

        }

        li {
            direction: rtl;

        }

        .exit1 {
            direction: ltr;
            text-align: right;

        }

        .user_name_li {
            direction: ltr;

        }

        .exit2 {
            height: 40px !important;

        }

        .a_face {
            text-decoration: none;

        }


        .a_face:hover {
            text-decoration: none;
        }


        .tag_a_default {
            color: (internal value);
            text-decoration: underline;
            cursor: pointer;
        }

    </style>

</head>

<body id="page-top">


    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav   sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->

            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('invoices.index') }}">
                <div class="sidebar-brand-icon ">
                    <i class="fa fa-quote-right text-warning"></i>
                </div>
                <div class="sidebar-brand-text mx-3">AL-HADAD </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed text-right" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-calculator "></i>
                    <small text-sm class="  text-light ">فواتير المبيعات</small>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="{{ route('invoices.create') }}">فاتورة جديدة</a>
                        <a class="collapse-item " href="{{ route('inv_data') }}">استعلام عن فاتورة</a>
                    </div>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-right mr-3" href="{{ ROUTE('cont_main_index') }}">
                    <i class="fa fa-address-card text-light " aria-hidden="true"></i>
                    <small>جهات الاتصال</small></a>

            </li>

            <br>
            <br>
            <br>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">


                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" id="nav1">


                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <ul class="navbar-nav ml-auto">



                        <li class="nav-item dropdown no-arrow user_name_li">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nickname }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/ahed.jpg') }}">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in exit2"
                                aria-labelledby="userDropdown">




                                <a class="dropdown-item exit1" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 exit2"></i>
                                    خروج
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>

                            </div>
                        </li>

                    </ul>

                </nav>


                <div class="container-fluid">


                    @yield('content')

                </div>



            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <a class="a_face" href="http://facebook.com"> <span class="text-success">Copyright
                                &copy; AL-HADAD {{ date('Y') }}</span></a>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>


    </div>


    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @yield('js')
    @yield('js2')
</body>

</html>
