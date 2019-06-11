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
    @php
        $a = "dd";
    @endphp
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
    <script>
        function clearTel() {
        console.log(room_tel3);
        for (var i = 1; i <= room_tel3; i++) {
            var input = document.querySelector("#phone"+i);
            window.intlTelInput(input, {
            utilsScript: "{{ asset('js/frontend_js/utils.js')}}",
            });
		}
    }
    function clearTel2() {
        console.log(room_tel2);
        for (var i = 1; i <= room_tel2; i++) {
            var input = document.querySelector("#old_tel"+i);
            input.innerHTML = <?php echo json_encode($mycontacts); ?>;
		}
    }
  </script>
  <script type="text/javascript">
		$(document).ready(function() {
    clearTel();
    clearTel2();
        });
    </script>
    <!--This page JavaScript -->
    <script src="{{ asset('libs/frontend_libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{ asset('extra-libs/frontend_extras_libs/jquery.repeater/repeater-init.js')}}"></script>
    <script src="{{ asset('extra-libs/frontend_extras_libs/jquery.repeater/dff.js')}}"></script>
    <!-- This Page JS -->
<!-- For intlTelInput -->
    <script src="{{ asset('js/frontend_js/intlTelInput.js')}}"></script>

</body>
</html>
