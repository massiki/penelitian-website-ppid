@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Buat password baru</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/pengguna/{{ $user->id }}/password" method="post">
        @csrf
        @method('patch')
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="name">
                    <h5 class="mb-0">Nama</h5>
                  </label>
                  <input class="w-100 form-control" type="name" value="{{ old('name') ?? $user->name }}" id="name"
                    name="name" disabled>
                </div>
                <div class="mb-4">
                  <label for="password">
                    <h5 class="mb-0">Password baru</h5>
                  </label>
                  <input class="w-100 form-control" type="password" value="{{ old('password') }}" id="password"
                    name="password">
                  @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <input type="checkbox" id="lihatpassword" onchange="showPassword()">
                    <label for="lihatpassword">Lihat Password</label>
                  </div>
                </div>
                <a href="/pengguna" class="btn btn-secondary">kembali</a>
                <button type="submit" class="btn btn-primary">Ubah</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
@endsection
