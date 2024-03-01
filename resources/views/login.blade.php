<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | {{ config('app.name') }}</title>
    <!-- Custom fonts for this template-->
    <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .form-group {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .field-icon {
            color: #aaa;
        }

        .field-icon:hover {
            color: #333;
        }

        body{
    background-image: url('pepe.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

    </style>
</head>
<body style="background-image: url('/template/img/pepe.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 text-gray-900">Welcome Back!</h1>
                                </div>
                                <form class="user" action="{{url('login/proses')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Username" name="username" autofocus required value="{{old('username')}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" required>
                                            <span class="toggle-password" onclick="togglePasswordVisibility(this)">
                                                <i class="fa fa-eye field-icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" name="login" value="login">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="template/vendor/jquery/jquery.min.js"></script>
<script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="template/js/sb-admin-2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    @if(session('success'))
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    Toast.fire({
        icon: 'success',
        title: '{{ session('
        success ') }}'
    })
    @endif
    @error('gagal')
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
        footer: '<a href="{{ route("password.request") }}">Reset Password</a>'
    })
    Toast.fire({
        icon: 'error',
        title: 'Username atau Password Salah'
    })
    @enderror


    function togglePasswordVisibility(icon) {
        var input = document.getElementById('password');
        if (input.type === 'password') {  
            input.type = 'text';
            icon.innerHTML = '<i class="fa fa-eye-slash field-icon"></i>';
        } else {
            input.type = 'password';
            icon.innerHTML = '<i class="fa fa-eye field-icon"></i>';
        }
    }
</script>
</body>
</html>
