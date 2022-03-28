<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bonus - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="position-relative">
      <div class="w-50 position-absolute" style="z-index: 1; right: 10px; top: 10px;">
        @if ($errors->all())
        <x-alert type="danger">
          @foreach ($errors->all() as $error)
          <ul>
            <li>{{$error}}</li>
          </ul>
          @endforeach
        </x-alert>
        @endif
      </div>
    </div>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-6">
        <div class="card o-hidden my-5 border-0 shadow-lg">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 mb-4 text-gray-900">Welcome Back!</h1>
                  </div>
                  {!! Form::open()->method('post')->attrs(['class' => 'user'])->route('auth.logar') !!}

                  {!! Form::text('login', 'Login')
                  ->placeholder('Enter Login ...')
                  ->attrs(['class' => 'form-control form-control-user'])
                  !!}

                  {!! Form::text('password', 'Password')
                  ->type('password')
                  ->attrs(['class' => 'form-control form-control-user '])
                  ->placeholder('Password')
                  !!}

                  {!! Form::button('Login')
                  ->type('submit')
                  ->attrs(['class' => 'btn btn-primary btn-user btn-block']) !!}
                  <hr>
                  {!! Form::close() !!}
                  <hr>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
