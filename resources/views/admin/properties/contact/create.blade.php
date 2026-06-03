@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Buat Kontak</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/kontak" method="post">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  <h4>Kontak</h4>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="address">
                    <h5 class="mb-0">Address</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('address') }}"
                    id="address" name="address">
                  @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="icon">
                    <h5 class="mb-0">Icon</h5>
                  </label>
                  <p class="mb-2">Catatan: Icon bisa di ambil dari website <a href="https://fontawesome.com/" target="_black">fontawesome v5</a></p>
                  <input class="w-100 form-control" type="text" value="{{ old('icon') }}"
                    id="icon" name="icon">
                  @error('icon')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <a href="/kontak" class="btn btn-secondary">kembali</a>
                <button type="submit" class="btn btn-primary">Buat</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
@endsection
