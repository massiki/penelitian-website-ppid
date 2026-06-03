@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Buat Pengguna</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/pengguna" method="post">
        @csrf
        @method('post')
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="name">
                    <h5 class="mb-0">Nama</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('name') }}"
                    id="name" name="name">
                  @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="email">
                    <h5 class="mb-0">Email</h5>
                  </label>
                  <input class="w-100 form-control" type="email" value="{{ old('email') }}"
                    id="email" name="email">
                  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="nip">
                    <h5 class="mb-0">NIP</h5>
                  </label>
                  <input class="w-100 form-control" type="nip" value="{{ old('nip') }}"
                    id="nip" name="nip" oninput="inputNip()">
                  @error('nip')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="role">
                    <h5 class="mb-0">Role</h5>
                  </label>
                  <select class="custom-select" name="role">
                    <option value=""></option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                    <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>operator</option>
                  </select>
                  @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="password">
                    <h5 class="mb-0">Password</h5>
                  </label>
                  <input class="w-100 form-control" type="password" value="{{ old('password') }}"
                    id="password" name="password">
                  @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="form-group">
                    <input type="checkbox" id="lihatpassword" onchange="showPassword()">
                    <label for="lihatpassword">Lihat Password</label>
                  </div>
                </div>
                <a href="/pengguna" class="btn btn-secondary">kembali</a>
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


