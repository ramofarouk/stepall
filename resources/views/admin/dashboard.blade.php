@extends('layouts.adminLayout.admin_design')
@section('title')
Tableau de bord
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
                        <h4 class="page-title">Tableau de bord</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <div class="m-r-10">
                                <div class="lastmonth"></div>
                            </div>
                            <div class=""><small>Messages envoyés</small>
                                <h4 class="text-info m-b-0 font-medium">{{ $number_messages }}</h4></div>
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
                <!-- Ravenue - page-view-bounce rate -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12 col-lg-6">
                        <div class="card bg-info">
                            <div class="card-body">
                                <h4 class="card-title text-white">Messages envoyés ce mois</h4>
                                <div class="d-flex align-items-center m-t-30">
                                    <div class="" id="ravenue"></div>
                                    <div class="ml-auto">
                                        <h2 class="text-white m-b-0"><i class="ti-arrow-up">{{ $number_messages }}</i></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                    <div class="col-sm-12 col-lg-6">
                        <div class="card bg-info">
                            <div class="card-body">
                                <h4 class="card-title text-white">Nombre d'utilisateurs</h4>
                                <div class="d-flex align-items-center m-t-30">
                                    <div class="" id="ravenue"></div>
                                    <div class="ml-auto">
                                        <h2 class="text-white m-b-0"><i class="ti-arrow-up">{{ $number_users }}</i></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Projects of the month -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Table -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
@endsection
