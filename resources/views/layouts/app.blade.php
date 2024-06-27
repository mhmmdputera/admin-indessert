<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/shop-2.png') }}" type="image/x-icon">

  <title>{{ $title ?? config('app.name') }} - Admin Online Shop</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <style>
    .form-control:focus {
      color: #6e707e;
      background-color: #fff;
      border-color: #375dce;
      outline: 0;
      box-shadow: none
    }
    .form-group label {
      font-weight: bold
    }
    #wrapper #content-wrapper {
      background-color: #e2e8f0;
      width: 100%;
      overflow-x: hidden;
    }
    .card-header {
      padding: .75rem 1.25rem;
      margin-bottom: 0;
      background-color: #c69a41;
      border-bottom: 1px solid #e3e6f0;
      color: white;
    }
  </style>

  <!-- jQuery -->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>  

  <!-- sweet alert -->
  <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>  

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="https://www.instagram.com/in.dessert_/">
        <div class="sidebar-brand-icon">
          <i class="fab fa-instagram"></i>
        </div>
        <div class="sidebar-brand-text mx-3">INDESSERT</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Request::is('admin/dashboard*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>DASHBOARD</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        MASTER
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ Request::is('admin/category*') ? ' active' :  '' }} {{ Request::is('admin/product*') ? ' active' :  '' }} {{ Request::is('admin/customer*') ? ' active' :  '' }} {{ Request::is('admin/slider*') ? ' active' :  '' }} {{ Request::is('admin/telegram*') ? ' active' :  '' }} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-shopping-bag"></i>
          <span>MASTER</span>
        </a>
        <div id="collapseTwo" class="collapse {{ Request::is('admin/category*') ? ' show' :  '' }} {{ Request::is('admin/product*') ? ' show' :  '' }} {{ Request::is('admin/customer*') ? ' show' :  '' }} {{ Request::is('admin/slider*') ? ' show' :  '' }}{{ Request::is('admin/telegram*') ? ' show' :  '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">DATA MASTER</h6>
            <a class="collapse-item {{ Request::is('admin/category*') ? ' active' : '' }}" href="{{ route('admin.category.index') }}">KATEGORI</a>
            <a class="collapse-item {{ Request::is('admin/product*') ? ' active' : '' }}" href="{{ route('admin.product.index') }}">PRODUK</a>
            <a class="collapse-item {{ Request::is('admin/customer*') ? ' active' : '' }}" href="{{ route('admin.customer.index') }}">CUSTOMER</a>
            <a class="collapse-item {{ Request::is('admin/slider*') ? ' active' : '' }}" href="{{ route('admin.slider.index') }}">SLIDERS</a>
            <a class="collapse-item {{ Request::is('admin/telegram*') ? ' active' : '' }}" href="{{ route('admin.telegram.index') }}">TELEGRAM</a>
          </div>
        </div>
      </li>

      <div class="sidebar-heading">
        TRANSAKSI
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item {{ Request::is('admin/order*') ? ' active' :  '' }} {{ Request::is('admin/riwayat*') ? ' active' :  '' }} ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-shopping-bag"></i>
          <span>TRANSAKSI</span>
        </a>
        <div id="collapseTransaksi" class="collapse {{ Request::is('admin/order*') ? ' show' :  '' }} {{ Request::is('admin/riwayat*') ? ' show' :  '' }} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">DATA TRANSAKSI</h6>
            <a class="collapse-item {{ Request::is('admin/order*') ? ' active' : '' }}" href="{{ route('admin.order.index') }}">ORDERS</a>  
            <a class="collapse-item {{ Request::is('admin/riwayat*') ? ' active' : '' }}" href="{{ route('admin.riwayat.index') }}">RIWAYAT PESANAN</a>  
          </div>
        </div>
      </li>

      {{-- <li class="nav-item {{ Request::is('admin/order*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{ route('admin.order.index') }}">
          <i class="fas fa-shopping-cart"></i>
          <span>ORDERS</span></a>
      </li> --}}  

      {{-- <li class="nav-item {{ Request::is('admin/slider*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{ route('admin.slider.index') }}">
          <i class="fas fa-laptop"></i>
          <span>SLIDERS</span></a>
      </li> --}}

      {{-- <li class="nav-item {{ Request::is('admin/profile*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{ route('admin.profile.index') }}">
          <i class="fas fa-user-circle"></i>
          <span>PROFILE</span></a>
      </li>

      <li class="nav-item {{ Request::is('admin/user*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
          <i class="fas fa-users"></i>
          <span>USERS</span></a>
      </li> --}}

      <div class="sidebar-heading">
        ALAMAT
      </div>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item {{ Request::is('admin/kabupaten*') ? ' active' :  '' }} {{ Request::is('admin/kecamatan*') ? ' active' :  '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAlamat" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-map-marker"></i>
          <span>ALAMAT</span>
        </a>
        <div id="collapseAlamat" class="collapse {{ Request::is('admin/kabupaten*') ? ' show' :  '' }} {{ Request::is('admin/kecamatan*') ? ' show' :  '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">DATA ALAMAT</h6>
            <a class="collapse-item {{ Request::is('admin/kabupaten*') ? ' active' : '' }}" href="{{ route('admin.kabupaten.index') }}">KABUPATEN</a>
            <a class="collapse-item {{ Request::is('admin/kecamatan*') ? ' active' : '' }}" href="{{ route('admin.kecamatan.index') }}">KECAMATAN</a>
          </div>
        </div>
      </li>

      <div class="sidebar-heading">
        PROFILE
      </div>

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item {{ Request::is('admin/profile*') ? ' active' :  '' }} {{ Request::is('admin/user*') ? ' active' :  '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-user-circle"></i>
          <span>PROFILE</span>
        </a>
        <div id="collapseProfile" class="collapse {{ Request::is('admin/profile*') ? ' show' :  '' }} {{ Request::is('admin/user*') ? ' show' :  '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">PROFILE & USER</h6>
            <a class="collapse-item {{ Request::is('admin/profile*') ? ' active' : '' }}" href="{{ route('admin.profile.index') }}">PROFILE</a>
            <a class="collapse-item {{ Request::is('admin/user*') ? ' active' : '' }}" href="{{ route('admin.user.index') }}">USER</a>
          </div>
        </div>
      </li>

      <div class="sidebar-heading">
        LAPORAN
      </div>

      <li class="nav-item {{ Request::is('admin/laporan*') ? ' active' :  '' }}">
        <a class="nav-link" href="{{ route('admin.laporan.index') }}">
          <i class="fas fa-file"></i>
          <span>LAPORAN</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

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

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ auth()->user()->avatar_url }}">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  LOGOUT
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Putera - 310120012689 &copy; 2024 Online Shop - Indessert </span>
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
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin Ingin Keluar ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Silahkan pilih "Logout" di bawah untuk mengakhiri sesi saat ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>

  <script>
    //sweetalert for success or error message
    @if(session()->has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 1500,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
  </script>
</body>
</html>