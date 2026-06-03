<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-image: url(''); background-size: cover; background-position: center;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary " >
    <div class="card-header text-center" >
      <a href="#" class="h1">Verifikasi Data</a>
    </div>
    <div class="card-body">
      <form action="#" method="post">
        @csrf
        @if (session('failed'))
          <div>
            <span class="text-danger">{{ session('failed') }}</span>
          </div>
        @endif
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Masukan NIK" inputmode="numeric" name="nik" id="nik" oninput="inputNik()" value="{{ old('nik') }}">
        </div>
        @error('nik')
        <div class="mb-3 mt-0">
          <span class="text-danger">{{ $message }}</span>
        </div>
        @enderror
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Masukan Email" name="email" value="{{ old('email') }}">
        </div>
        @error('email')
        <div class="mb-3 mt-0">
          <span class="text-danger">{{ $message }}</span>
        </div>
        @enderror
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="/dist/js/app.js"></script>
</body>
</html>

