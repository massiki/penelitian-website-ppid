@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit {{ ucfirst($slug) }}</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/image/{{ $item->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="image">
                    <h5 class="mb-0">{{ ucfirst($slug) }}</h5>
                  </label>
                  <div class="input-group mb-2">
                    <div class="mb-2">
                      <img src="/storage/{{ $item->image }}" class="w-100" id="previewImage">
                    </div>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imageInput" name="image" onchange="showIframe()">
                        <label class="custom-file-label" for="image">Pilih file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload {{ ucfirst($slug) }}</span>
                      </div>
                    </div>
                    @error('image')
                      <div class="alert alert-danger w-100">{{ $message }}</div>
                    @enderror
                  </div>
                  <a href="/image_video" class="btn btn-secondary">kembali</a>
                  <button type="submit" class="btn btn-primary">Ubah</button>
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
