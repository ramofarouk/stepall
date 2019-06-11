@extends('layouts.frontLayout.user_design')
@section('title')
Mon profil
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
                                    <li class="breadcrumb-item"><a href="{{url('/user')}}">Tableau de bord</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Mettre à jour les informations</li>
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
                <form class="form p-t-20" method="POST" action="{{ url('/user/my-profile')}}">
                    {{ csrf_field() }}
                    <input type="text" value="{{ $user->id }}" name="id" hidden>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Veuillez modifer vos informations</h4>
                            </div>
                            <div class="card-body">
                                    <div class="row p-t-20">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{ $user->last_name }}" name="last_name" placeholder="Nom" aria-label="Username" aria-describedby="basic-addon11" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Prénoms</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{ $user->first_name}}" name="first_name" placeholder="Prénoms" aria-label="Username" aria-describedby="basic-addon11" required>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row p-t-20">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom d'expéditeur</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{ $user->pseudo}}" name="pseudo" placeholder="Nom d'expéditeur" aria-label="Username" aria-describedby="basic-addon11" required>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11"><i class="ti-email"></i></span>
                                            </div>
                                            <input type="email" class="form-control" value="{{ $user->email}}" name="email" placeholder="Email" aria-label="Username" aria-describedby="basic-addon11" required>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row p-t-20">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                        <label>Numéro de téléphone</label>
                                        <div class="input-group mb-3">
                                             <input id="phone1" name="phone" value="{{$user->telephone}}" type="tel" class="form-control form-control-lg" required>
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
                                        <center><input type="submit" class="btn btn-success m-r-10" value="MODIFIER VOS INFORMATIONS"></center>
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
