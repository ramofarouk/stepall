<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/frontend_images/favicon.png')}}">
    <title>StepAll | Connectez-vous</title>
    <!-- Custom CSS -->
    <link href="{{ asset('css/frontend_css/style.min.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(/images/frontend_images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
            @if (Session::has('flash_message_error'))
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ session('flash_message_error') }}", "Merci", "error");
  	            </script>
            @endif
            @if (Session::has('flash_message_success'))
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ session('flash_message_success') }}", "OK", "success");
  	            </script>
            @endif
                    <div class="logo">
                        <span class="db"><img src="{{ asset('images/frontend_images/logo-icon.png')}}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Connectez-vous à StepAll</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" method="POST" id="loginform" action="{{url('/')}}">
                                 {{ csrf_field() }}
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg" name="email_or_telephone" required placeholder="Email ou Numéro de téléphone" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Mot de passe" aria-label="Password" required aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Se Souvenir de moi</label>
                                            <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Mot de passe oublié?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                       <input class="btn btn-block btn-lg btn-info" name="submit" type="submit" value="SE CONNECTER">
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        Vous ne possédez pas de compte ? <a href="{{url('/register-user')}}" class="text-info m-l-5"><b>Créer un compte</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('images/frontend_images/logo-icon.png')}}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Recover Password</h5>
                        <span>Entrer votre Email et des instructions vous seront envoyés</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" action="">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input class="form-control form-control-lg" type="text" required="" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">REINITIALISER</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('libs/frontend_libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('libs/frontend_libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('libs/frontend_libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>
</body>


</html>
