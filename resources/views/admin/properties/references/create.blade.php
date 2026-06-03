@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Buat {{ Str::ucfirst($slug) }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/references" method="post">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <input type="hidden" name="slug" value="{{ $slug }}">
                  <label for="nama">
                    <h5 class="mb-0">{{ Str::ucfirst($slug) }}</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('nama') }}"
                    id="nama" name="nama">
                  @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <a href="/references" class="btn btn-secondary">kembali</a>
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
