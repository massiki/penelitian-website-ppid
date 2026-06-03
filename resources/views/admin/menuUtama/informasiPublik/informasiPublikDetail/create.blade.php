@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Buat Informasi Publik Detail</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/informasi_publik/{{ $informasiPublikId }}/detail" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-body table-responsive p-3">
                <input type="hidden" value="{{ $informasiPublikId }}" name="informasi_publik_id">
                <div class="mb-4">
                  <label for="tahun">
                    <h5 class="mb-0">Tahun</h5>
                  </label>
                  <select class="custom-select" name="tahun">
                    @php
                      $currentYear = date('Y');
                      $startYear = 2000;
                    @endphp
                    <option value=""></option>
                    @for ($year = $currentYear; $year >= $startYear; $year--)
                      <option value="{{ $year }}"
                        {{ old('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                  </select>
                  @error('tahun')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="ringkasan_informasi">
                    <h5 class="mb-0">Informasi</h5>
                  </label>
                  <textarea class="w-100 form-control" name="informasi" cols="30" id="informasi">{{ old('informasi') }}</textarea>
                  @error('informasi')
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
                  <label for="link">
                    <h5 class="mb-0">PDF</h5>
                  </label>
                  <div class="input-group">
                    <div id="iframeContainer" style="display: none;"> 
                      <iframe src="" frameborder="0" id="previewImage"></iframe>
                    </div>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imageInput" name="link" onchange="showIframe()">
                        <label class="custom-file-label" for="link">Pilih file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload PDF</span>
                      </div>
                    </div>
                  </div>
                  @error('link')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <a href="/informasi_publik/{{ $informasiPublikId }}/detail" class="btn btn-secondary">kembali</a>
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
