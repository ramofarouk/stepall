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
    <title>StepAll | Créer un compte</title>
    <!-- Custom CSS -->
    <!-- For intlInputTel -->
    <link href="{{ asset('css/frontend_css/intlTelInput.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/style.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/demo.css')}}" rel="stylesheet">
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
                <div>
            @if (Session::has('flash_message_error'))
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ session('flash_message_error') }}", "Merci", "error");
  	            </script>
            @endif
            @if (Session::has('flash_message_success'))
                <script type="text/javascript" src="{{ asset('js/frontend_js/sweetalert.min.js')}}"></script>
  	            <script type="text/javascript">;
  	                swal("{{ session('flash_message_success') }}", "Veuillez réessayer", "success");
  	            </script>
            @endif
                    <div class="logo">
                        <span class="db"><img src="{{ asset('images/frontend_images/logo-icon.png')}}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Inscrivez-vous rapidement</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" method="POST" action="{{url('/register-user')}}">
                                {{ csrf_field() }}
                                <div class="form-group row ">
                                    <div class="col-6 ">
                                        <input class="form-control form-control-lg" name="last_name" type="text" required placeholder="Nom">
                                    </div>
                                   <div class="col-6 ">
                                        <input class="form-control form-control-lg" name="first_name" type="text" required placeholder="Prénoms">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-lg" name="pseudo" type="text" required placeholder="Nom d'expéditeur">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-lg" name="email" type="email" required placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input id="phone" name="phone" type="tel" class="form-control form-control-lg" style="width:360px;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-lg" name="password" type="password" required placeholder="Mot de passe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-lg" name="c_password" type="password" required placeholder="Confirmation de mot de passe">
                                    </div>
                                </div>
                                <div class="form-group text-center ">
                                    <div class="col-xs-12 p-b-20 ">
                                        <input class="btn btn-block btn-lg btn-info" name="submit" type="submit" value="S'INSCRIRE">
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10 ">
                                    <div class="col-sm-12 text-center ">
                                        Avez-vous déjà un compte? <a href="{{url('/')}}" class="text-info m-l-5 "><b>Se Connecter</b></a>
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
    <script src="{{ asset('js/frontend_js/intlTelInput.js')}}"></script>
    <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      utilsScript: "{{ asset('js/frontend_js/utils.js')}}",
    });
  </script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();
    </script>
</body>


</html>
