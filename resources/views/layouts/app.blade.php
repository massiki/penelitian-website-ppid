<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ========== Meta Tags ========== -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="modinatheme">
  <!-- ======== Page title ============ -->
  <title>{{ config('app.name') }}</title>
  <!-- ========== Favicon Icon ========== -->
  <link rel="shortcut icon" href="{{ asset('storage/' . $logo->image) }}">
  <!-- ===========  All Stylesheet ================= -->
  <!--  Icon css plugins -->
  <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
  <!--  animate css plugins -->
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
  <!--  slick css plugins -->
  <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
  <!--  magnific-popup css plugins -->
  <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
  <!-- metis menu css file -->
  <link rel="stylesheet" href="{{ asset('assets/css/metismenu.css') }}">
  <!-- select2 css file -->
  <link rel="stylesheet" href="{{ asset('assets/css/nice-select2.css') }}">
  <!--  Bootstrap css plugins -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <!--  main style css file -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <!-- template main style css file -->
  <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
</head>

<body class="body-wrapper">

  {{-- alert success --}}
  @if (session('success'))
    <div class="container position-fixed top-50 start-50 translate-middle p-2 text-center" style="z-index: 1050;">
      <div class="alert fade show" role="alert">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="success-message">
              <img src="/assets/img/success.png" alt="check">
              <h2>Berhasil!</h2>
              <p>{{ session('success') }}</p>
              @if (session('email'))
                <form action="/riwayat">
                  <input type="hidden" value="{{ session('email') }}" name="email">
                  <button type="submit" class="btn btn-success">Cek Status</button>
                </form>
              @else
                <button class="btn btn-success" data-bs-dismiss="alert" aria-label="Close">Tutup</button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

  @include('components.preloader')

  @include('components.nav')

  @yield('content')

  @include('components.footer')

  <!-- WhatsApp Floating Button -->
  <a href="https://wa.me/6281234567890" target="_blank" class="whatsapp-float" aria-label="Chat via WhatsApp">
    <img src="{{ asset('assets/img/icon-whatsapp.webp') }}" alt="WhatsApp" width="60" height="60">
  </a>

  <!--  ALl JS Plugins
    ====================================== -->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.easing.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/js/imageload.min.js') }}"></script>
  <script src="{{ asset('assets/js/scrollUp.min.js') }}"></script>
  <script src="{{ asset('assets/js/slick.min.js') }}"></script>
  <script src="{{ asset('assets/js/slick-animation.min.js') }}"></script>
  <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
  <script src="{{ asset('assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/metismenu.js') }}"></script>
  <script src="{{ asset('assets/js/nice-select2.js') }}"></script>
  <script src="{{ asset('assets/js/active.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
