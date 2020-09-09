<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DigiSac - Skeleton</title>
    <!-- Fonts -->
    <link href="/vendor/digisac/core-integration-laravel/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">    <!-- Styles -->
    <link href="/vendor/digisac/core-integration-laravel/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/vendor/digisac/core-integration-laravel/img/favicon.jpg" type="image/x-icon">
    <script src="/vendor/digisac/core-integration-laravel/js/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <div class="sidebar-brand-icon">
                <img class="w-100 p-4 " src="/vendor/digisac/core-integration-laravel/img/logo.png" alt="DigiSac - Plataforma Multicanal"
                     title="DigiSac - PABX Digital"/>
            </div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item ">
            <a class="nav-link" href="/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Opções
        </div>
        <!-- Nav Item - Profile -->
        <li class="nav-item active">
            <a class="nav-link" href="/company">
                <i class="fas fa-fw fa-building"></i>
                <span>Empresas</span>
            </a>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-arrow-up"></i>
                <span>Requisições</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/send-request?type=DigiSac">DigiSac</a>
                    <a class="collapse-item" href="/send-request?type=Yank">Yank</a>
                </div>
            </div>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-arrow-down"></i>
                <span>Webhook</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar" style="">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/webhook?type=DigiSac">DigiSac</a>
                </div>
            </div>
        </li>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>&nbsp;
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="/logout">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Sair
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @if(Session::has('message'))
                    <div class="alert alert-{{Session::get('message')['type']}} w-100 d-lg-block text-left">
                        <strong class="w-100 d-lg-block">{{Session::get('message')['message']}}</strong>
                    </div>
                    <?php   Session::remove('message'); ?>
                @endif

                @yield('content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; DigiSac {{date('Y')}}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- Scripts -->
<script src="/vendor/digisac/core-integration-laravel/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/vendor/digisac/core-integration-laravel/js/sb-admin-2.min.js"></script>
<script>
    $(function(){

        $('body').on('click','.delete',function(){
            swal({
                title: "Tem certeza que deseja deletar este registro?",
                text: "Esta ação não poderá ser revertida.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((confirm) => {
                    if (confirm) {
                       window.location = '/'+$(this).attr('data-url')+'/'+$(this).attr('data-id')+'/destroy';
                    } else {
                        //--
                    }
                });
        });

    })
</script>
</body>
</html>
