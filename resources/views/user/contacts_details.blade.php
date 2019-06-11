@extends('layouts.frontLayout.user_design2')
@section('title')
Contacts Details
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
                        <h4 class="page-title"> Contacts Details</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/user')}}">Tableau de bord</a></li>
                                    <li class="breadcrumb-item"><a href="{{url('/user/view-contacts')}}">Mes contacts</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$contactDetails->last_name . ' ' .$contactDetails->first_name}}</li>
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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30">
                                    <img src="{{ asset('/'.$contactDetails->url_photo) }}" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">{{$contactDetails->last_name . ' ' .$contactDetails->first_name}}</h4>
                                    <h6 class="card-subtitle">{{$contactDetails->note}}</h6>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill"  role="tab" aria-controls="pills-profile" aria-selected="false">Contact</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Nom</strong>
                                                <br>
                                                <p class="text-muted">{{$contactDetails->last_name}}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Prénoms</strong>
                                                <br>
                                                <p class="text-muted">{{$contactDetails->first_name}}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Note</strong>
                                                <br>
                                                <p class="text-muted">{{$contactDetails->note}}</p>
                                            </div>
                                        </div>
                                        <h4 class="font-medium m-t-30">Numéro de téléphone</h4>
                                        <hr>
                                        @foreach ($telephones as $telephone)
                                        <h5 class="m-t-30">{{$telephone->type_numero}} : </h5>
                                        <h6 style="color:#36BEA6">{{$telephone->numero}}</h6>
                                        @endforeach
                                        <h4 class="font-medium m-t-30">Email</h4>
                                        <hr>
                                        @foreach ($emails as $email)
                                        <h5 class="m-t-30">{{$email->type_mail}} : </h5>
                                        <h6 style="color:#FFA962">{{$email->email}}</h6>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
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
