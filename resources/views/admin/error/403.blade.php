@extends('layouts.admin')

@section('content')
<div class="content-wrapper pt-5">
  <!-- Main content -->
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-danger">403</h2>
      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Telah terjadi kesalahan.</h3>
        <p>
          Mohon maaf halaman ini tidak bisa anda akses <a href="/dashboard">kembali ke dashboard</a>
        </p>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection
