<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/frontend_images/favicon.png')}}">
    <title>StepAll | @yield('title')</title>
    <!-- chartist CSS -->
    <link href="{{ asset('libs/frontend_libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{ asset('libs/frontend_libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <!--c3 CSS -->
    <!-- This page plugin CSS -->
    <link href="{{ asset('libs/frontend_libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{ asset('extra-libs/frontend_extras_libs/c3/c3.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/frontend_css/style.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/intlTelInput.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
@include('layouts.frontLayout.user_header')


@include('layouts.frontLayout.user_sidebar')

@yield('content')

@include('layouts.frontLayout.user_footer')
<body>

    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('libs/frontend_libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('libs/frontend_libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('libs/frontend_libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <script src="{{ asset('js/frontend_js/app.min.js')}}"></script>
    <script src="{{ asset('js/frontend_js/app.init.light-sidebar.js')}}"></script>
    <script src="{{ asset('js/frontend_js/app-style-switcher.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('libs/frontend_libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{ asset('extra-libs/frontend_extras_libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/frontend_js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/frontend_js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/frontend_js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    <script src="{{ asset('libs/frontend_libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{ asset('libs/frontend_libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <!--c3 JavaScript -->
    <script src="{{ asset('extra-libs/frontend_extras_libs/c3/d3.min.js')}}"></script>
    <script src="{{ asset('extra-libs/frontend_extras_libs/c3/c3.min.js')}}"></script>
    <script src="{{ asset('libs/frontend_libs/chart.js/dist/chart.min.js')}}"></script>
    <script src="{{ asset('js/frontend_js/pages/dashboards/dashboard7.js')}}"></script>
    <!--This page plugins -->
    <script src="{{ asset('extra-libs/frontend_extras_libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/frontend_js/pages/datatable/datatable-advanced.init.js')}}"></script>
    <!--This page JavaScript -->
    <script src="{{ asset('libs/frontend_libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{ asset('extra-libs/frontend_extras_libs/jquery.repeater/repeater-init.js')}}"></script>
    <script src="{{ asset('extra-libs/frontend_extras_libs/jquery.repeater/dff.js')}}"></script>
<!-- For intlTelInput -->
    <script src="{{ asset('js/frontend_js/intlTelInput.js')}}"></script>
    <script>
function telephone_editing_fields() {
    room_tel_editing++;
    var objTo = document.getElementById('telephone_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room_tel_editing);
    var rdiv = 'removeclass' + room_tel_editing;
    divtest.innerHTML = '<div class="row"><div class="col-sm-4"><div class="form-group"><select class="form-control" id="educationDate" name="type_tel' + room_tel_editing + '" required><option value=""> Choisir le type de numéro</option><option value="Perso">Perso</option><option value="Prof">Prof</option><option value="Autre">Autre</option></select ></div></div><div class="col-sm-2"><div class="form-group"><input id="phone' + room_tel_editing + '" type="tel" name ="phone' + room_tel_editing + '" class="form-control" required></div></div></div>';
    objTo.appendChild(divtest)
    loadTel();
}

function remove_telephone_editing_fields() {
    if(room_tel_editing > 1){
        $('.removeclass' + room_tel_editing).remove();
        room_tel_editing -= 1;
        loadTel();
    }

}
        //For editing email fields
var room_email_editing = 1;
function update_email_fields(indice) {
    room_email_editing = indice;
    console.log(room_email_editing);

}
function email_editing_fields() {

    room_email_editing++;
    var objTo = document.getElementById('email_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room_email_editing);
    var rdiv = 'removeclass' + room_email_editing;
    divtest.innerHTML = '<div class="row"><div class="col-sm-4"><div class="form-group"><select class="form-control" id="educationDate" name="type_mail' + room_email_editing + '" required><option value="">Type mail</option><option value="Perso">Perso</option><option value="Prof">Prof</option><option value="Autre">Autre</option></select></div></div><div class="col-sm-2"><div class="form-group"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon22"><i class="ti-email"></i></span></div><input type="email" class="form-control" name="mail' + room_email_editing + '" placeholder="Email" aria-label="Email" aria-describedby="basic-addon22" required></div></div></div></div>';

    objTo.appendChild(divtest)
}
function remove_email_editing_fields() {
    if (room_email_editing > 1) {
        $('.removeclass' + room_email_editing).remove();
        room_email_editing -= 1;
    }
}
    </script>
    <script>
        function loadTel() {
        for (var i = 1; i <= room_tel_editing; i++) {
            var input = document.querySelector("#phone"+i);
            window.intlTelInput(input, {
            utilsScript: "{{ asset('js/frontend_js/utils.js')}}",
            });
		}
    }
  </script>

      <script type="text/javascript">
		$(document).ready(function() {
            var numberTotalOfPhones = <?php echo json_encode($telephones->count()); ?>;
            room_tel_editing=numberTotalOfPhones;
            loadTel();
            update_email_fields(<?php echo json_encode($emails->count()); ?>);
        });
    </script>
</body>
</html>
