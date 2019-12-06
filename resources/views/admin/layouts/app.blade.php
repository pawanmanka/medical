<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}@if (trim($__env->yieldContent('title')))- @yield('title')@endif</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link href="{{ baseUrl('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ baseUrl('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

     @yield('customStyle')
    <link href="{{ baseUrl('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ baseUrl('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ baseUrl('admin/css/styleSheet.css') }}" rel="stylesheet">
    <link href="{{ baseUrl('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ baseUrl('plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <script type="text/javascript">
		var SITE_URL="{{ url('administrator') }}";
    </script>
    

</head>

<body>

<div id="wrapper">

     @include('admin.layouts.navigation')

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
               
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="{{ url('administrator/logout') }}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
          @yield('content')
        <div class="footer">
           
            <div>
                <strong>Copyright</strong> {{ config('app.name') }} {{date('Y')}}
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ baseUrl('admin/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ baseUrl('js/scripts/app.js') }}"></script>
<script src="{{ baseUrl('admin/js/popper.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ baseUrl('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ baseUrl('admin/js/inspinia.js') }}"></script>
<script src="{{baseUrl('admin/js/plugins/pace/pace.min.js')}}"></script>
<script src="{{baseUrl('plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{baseUrl('plugins/toastr/toastr.min.js')}}"></script>

@yield('customScript')

</body>

</html>
