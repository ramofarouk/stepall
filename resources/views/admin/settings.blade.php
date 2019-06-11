@extends('layouts.adminLayout.admin_design')
@section('title')
Paramètres
@endsection
@section('content')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Paramètres</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Tableau de bord</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Mettre à jour son mot de passe</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
           @if (Session::has('flash_message_success'))
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ session('flash_message_success') }}", "BIEN", "success");
  	            </script>
            @endif
            @if (Session::has('flash_message_error'))
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ session('flash_message_error') }}", "OK", "error");
  	            </script>
            @endif
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <form class="form p-t-20" method="POST" action="{{ url('/admin/change-password-admin')}}">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Veuillez renseigner les informations</h4>
                            </div>
                            <div class="card-body">
                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                        <label>Mot de passe actuel</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" name="c_password" placeholder="Mot de passe actuel" aria-label="Username" aria-describedby="basic-addon11" required>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row p-t-20">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nouveau Mot de passe</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" name="n_password" placeholder="Nouveau Mot de passe" aria-label="Username" aria-describedby="basic-addon11" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirmation</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" name="cn_password" placeholder="Confirmation" aria-label="Username" aria-describedby="basic-addon11" required>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <center><input type="submit" class="btn btn-success m-r-10" value="MODIFIER"></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                 </form>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
@endsection
