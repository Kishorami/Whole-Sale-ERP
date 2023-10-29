<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Registration Page (v2)</title>
        
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ route('login') }}" class="h1"><b>SERP</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg"><b>Register</b></p>
                    
                    <x-jet-validation-errors class="mb-4" />

                    <form  method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input class="form-control" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Retype Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <a href="{{ route('login') }}" class="text-center">I already have an Account</a>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    
                </div>
                <!-- /.form-box -->
                </div><!-- /.card -->
            </div>
            <!-- /.register-box -->
            
            <!-- jQuery -->
            <script src="assets/plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="assets/dist/js/adminlte.min.js"></script>
        </body>
    </html>