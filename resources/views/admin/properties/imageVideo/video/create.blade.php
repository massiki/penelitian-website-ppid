@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Buat Url</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/video" method="post">
        @csrf
        @method('post')
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="image">
                    <h5 class="mb-0">Url</h5>
                  </label>
                  <div class="input-group mb-2">
                    <input class="w-100 form-control" type="text" value="{{ old('url') }}" id="url" name="url">
                    @error('url')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <a href="/image_video" class="btn btn-secondary">kembali</a>
                  <button type="submit" class="btn btn-primary">Buat</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
@endsection
