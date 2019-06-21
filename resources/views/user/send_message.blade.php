@extends('layouts.frontLayout.user_design3')
@section('title')
Envoyer un message
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
                        <h4 class="page-title">Envoyer un message</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/user')}}">Tableau de bord</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Envoyer un message</li>
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
  	                swal("{{ session('flash_message_success') }}", "OK", "success");
  	            </script>
            @endif
            @if (Session::has('flash_message_error'))
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ session('flash_message_error') }}", "OK", "success");
  	            </script>
            @endif
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <form class="form p-t-20" method="POST" action="{{ url('/user/send-message')}}">
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
                                        <label for="exampleInputEmail1">Taper votre message</label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" name="message" placeholder="Taper votre message" aria-label="Email" aria-describedby="basic-addon22" required></textarea>
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
                                <h4 class="card-title">Ajouter un numéro</h4>
                                <div id="telephone2_fields" class=" m-t-20"></div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                             <input id="phone1" name="phone1" type="tel" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <button class="btn btn-success" type="button" onclick="telephone2_fields();"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-danger" type="button" onclick="remove_telephone2_fields();"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Mon repertoire</h4>
                                <div id="telephone3_fields" class=" m-t-20"></div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                <select class="select2 form-control custom-select" name="old_tel1" id="old_tel1" style="width: 100%; height:36px;">

                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <button class="btn btn-success" type="button" onclick="telephone3_fields();"><i class="fa fa-plus"></i></button>
                                             <button class="btn btn-danger" type="button" onclick="remove_telephone3_fields();"><i class="fa fa-minus"></i></button>
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
                                        <center><input type="submit" class="btn btn-success m-r-10" value="ENVOYER LE MESSAGE"></center>
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
