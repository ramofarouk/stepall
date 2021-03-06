@extends('layouts.frontLayout.user_design4')
@section('title')
Editer un contact
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
                        <h4 class="page-title">Editer un contact</h4>
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

             @if (Session::has('flash_message_success'))
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ session('flash_message_success') }}", "OK", "success");
  	            </script>
            @endif
            @foreach ($errors->all() as $error)
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ $error }}", "OK", "error");
  	            </script>
            @endforeach
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <form class="form p-t-20" method="POST" action="{{ url('/user/edit-contact/'.$contactDetails->id)}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Veuillez modifier les informations</h4>
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
                                            <input type="text" class="form-control" value="{{ $contactDetails->last_name }}" name="last_name" placeholder="Nom" aria-label="Username" aria-describedby="basic-addon11" required>
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
                                            <input type="text" class="form-control" value="{{ $contactDetails->first_name }}" name="first_name" placeholder="Prénoms" aria-label="Username" aria-describedby="basic-addon11" required>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Modifier une note</label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" name="note" placeholder="Ajouter une note" aria-label="Email" aria-describedby="basic-addon22" required>{{ $contactDetails->note }}</textarea>
                                        </div>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label>Modifier la photo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Téléverser</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choisir un fichier</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Numéro de téléphone</h4>
                                <div id="telephone_fields" class=" m-t-20"></div>
                                    @for ($i = 0; $i < $telephones->count(); $i++)
                                    <div class="form-group removeclass<?= $i+1 ?>">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control" id="educationDate" name="type_tel<?= $i+1 ?>" required>
                                                        <option value="">Choisir le type de numéro</option>
                                                        <option value="Perso" <?= ($telephones[$i]->type_numero=="Perso")?"selected":""?>>Perso</option>
                                                        <option value="Prof" <?= ($telephones[$i]->type_numero=="Prof")?"selected":""?>>Prof</option>
                                                        <option value="Autre" <?= ($telephones[$i]->type_numero=="Autre")?"selected":""?>>Autre</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <input id="phone<?= $i+1 ?>" name="phone<?= $i+1 ?>" value="<?= $telephones[$i]->numero ?>" type="tel" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <button class="btn btn-success" type="button" onclick="telephone_editing_fields();"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-danger" type="button" onclick="remove_telephone_editing_fields();"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Email</h4>
                                <div id="email_fields" class=" m-t-20"></div>
                                 @for ($i = 0; $i < $emails->count(); $i++)
                                    <div class="form-group removeclass<?= $i+1 ?>">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control" id="educationDate" name="type_mail<?= $i+1 ?>" required>
                                                        <option value="Perso" <?= ($emails[$i]->type_mail=="Perso")?"selected":""?>>Perso</option>
                                                        <option value="Prof" <?= ($emails[$i]->type_mail=="Prof")?"selected":""?>>Prof</option>
                                                        <option value="Autre" <?= ($emails[$i]->type_mail=="Autre")?"selected":""?>>Autre</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon22"><i class="ti-email"></i></span>
                                                        </div>
                                                        <input type="email" class="form-control" name="mail<?= $i+1 ?>" value="<?= $emails[$i]->email ?>" placeholder="Email" aria-label="Email" aria-describedby="basic-addon22" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <button class="btn btn-success" type="button" onclick="email_editing_fields();"><i class="fa fa-plus"></i></button>
                                             <button class="btn btn-danger" type="button" onclick="remove_email_editing_fields();"><i class="fa fa-minus"></i></button>
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
                                        <center><input type="submit" class="btn btn-success m-r-10" value="MOIFIER LE CONTACT"></center>
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
