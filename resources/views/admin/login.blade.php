<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }}</title>

    <link href="{{ baseUrl('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ baseUrl('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ baseUrl('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ baseUrl('admin/css/style.css') }}" rel="stylesheet">

</head>


<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                {{-- <h1 class="logo-name">IN+</h1> --}}
            </div>
            <h3>{{ config('app.name') }}</h3>
           
            <p>Login in. To see it in action.</p>
            <form class="m-t" method="POST" role="form" action="">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Username" required="">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

              
            </form>
        </div>
    </div>

 <!-- Mainly scripts -->
<script src="{{ baseUrl('admin/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/popper.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/bootstrap.min.js') }}"></script>

</body>


</html>
