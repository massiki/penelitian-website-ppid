@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Buat Informasi Publik</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/informasi_publik" method="post">
        @csrf
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="ringkasan_informasi">
                    <h5 class="mb-0">Ringkasan</h5>
                  </label>
                  <textarea class="w-100 form-control" name="ringkasan_informasi" cols="30" id="ringkasan_informasi">{{ old('ringkasan_informasi') }}</textarea>
                  @error('ringkasan_informasi')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="pejabat_penguasa_informasi">
                    <h5 class="mb-0">Pejabat Penguasa Informasi</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('pejabat_penguasa_informasi') }}"
                    id="pejabat_penguasa_informasi" name="pejabat_penguasa_informasi">
                  @error('pejabat_penguasa_informasi')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="penanggung_jawab_informasi">
                    <h5 class="mb-0">Penanggung Jawab Informasi</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('penanggung_jawab_informasi') }}"
                    id="penanggung_jawab_informasi" name="penanggung_jawab_informasi">
                  @error('penanggung_jawab_informasi')
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
                  <label for="pekerjaan">
                    <h5 class="mb-0">Apakah Informasi berbentuk cetak?</h5>
                  </label>
                  <div class="form-group">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="cetak_ya" name="bentuk_informasi_cetak"
                        value="1" {{ old('bentuk_informasi_cetak') == '1' ? 'checked' : '' }}>
                      <label for="cetak_ya" class="custom-control-label form-check-label">Ya</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="cetak_tidak" name="bentuk_informasi_cetak"
                        value="0" {{ old('bentuk_informasi_cetak') == '0' ? 'checked' : '' }}>
                      <label for="cetak_tidak" class="custom-control-label form-check-label">Tidak</label>
                    </div>
                  </div>
                  @error('bentuk_informasi_cetak')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="pekerjaan">
                    <h5 class="mb-0">Apakah Informasi berbentuk digital?</h5>
                  </label>
                  <div class="form-group">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="digital_ya" name="bentuk_informasi_digital"
                        value="1" {{ old('bentuk_informasi_digital') == '1' ? 'checked' : '' }}>
                      <label for="digital_ya" class="custom-control-label form-check-label">Ya</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="digital_tidak"
                        name="bentuk_informasi_digital" value="0"
                        {{ old('bentuk_informasi_digital') == '0' ? 'checked' : '' }}>
                      <label for="digital_tidak" class="custom-control-label form-check-label">Tidak</label>
                    </div>
                  </div>
                  @error('bentuk_informasi_digital')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="memperoleh">
                    <h5 class="mb-0">Jangka Waktu Penyimpanan</h5>
                  </label>
                  <select class="custom-select" id="waktu_penyimpanan_id" name="waktu_penyimpanan_id">
                    <option></option>
                    @foreach ($storages as $item)
                      <option value="{{ $item->id }}"
                        {{ old('waktu_penyimpanan_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                      </option>
                    @endforeach
                  </select>
                  @error('waktu_penyimpanan_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="memperoleh">
                    <h5 class="mb-0">Kategori Informasi</h5>
                  </label>
                  <select class="custom-select" id="kategori_informasi_id" name="kategori_informasi_id">
                    <option></option>
                    @foreach ($categories as $item)
                      <option value="{{ $item->id }}"
                        {{ old('kategori_informasi_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                      </option>
                    @endforeach
                  </select>
                  @error('kategori_informasi_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                {{-- <div class="mb-4">
                  <label for="link">
                    <h5 class="mb-0">Link</h5>
                  </label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="link" name="link">
                      <label class="custom-file-label" for="link">Pilih file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                  @error('link')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div> --}}
                <a href="/informasi_publik" class="btn btn-secondary">kembali</a>
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
