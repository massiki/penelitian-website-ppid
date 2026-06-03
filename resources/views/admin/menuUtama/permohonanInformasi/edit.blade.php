@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Permohonan Informasi Edit</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/permohonan_informasi/{{ $permohonanInformasi->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
      <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  <h4>Biodata</h4>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="nama_lengkap">
                    <h5 class="mb-0">Nama Lengkap</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('nama') ?? $permohonanInformasi->nama }}" id="nama_lengkap" name="nama" required>
                  @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="email">
                    <h5 class="mb-0">Email</h5>
                  </label>
                  <input class="w-100 form-control" type="email" value="{{ old('email') ?? $permohonanInformasi->email }}" id="email" name="email" required>
                  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="phone">
                    <h5 class="mb-0">Telepon</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('no_telepon') ?? $permohonanInformasi->no_telepon }}" id="phone" name="no_telepon" inputmode="numeric" oninput="inputPhone()" required>
                  @error('no_telepon')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="pekerjaan">
                    <h5 class="mb-0">Pekerjaan</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('pekerjaan') ?? $permohonanInformasi->pekerjaan }}" id="pekerjaan" name="pekerjaan" required>
                  @error('pekerjaan')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label  for="alamat">
                    <h5 class="mb-0">Alamat</h5>
                  </label>
                  <textarea class="w-100 form-control" name="alamat" cols="30" id="alamat" required>{{ old('alamat') ?? $permohonanInformasi->alamat }}</textarea>
                  @error('alamat')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="nik">
                    <h5 class="mb-0">Nik</h5>
                  </label>
                  <input class="w-100 form-control" type="text" value="{{ old('nik') ?? $permohonanInformasi->nik }}" id="nik" name="nik" inputmode="numeric" oninput="inputNik()" required>
                  @error('nik')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="imageInput">
                    <h5 class="mb-0">Foto Ktp</h5>
                  </label>
                  <div> 
                    <img src="{{ asset('storage/'.$permohonanInformasi->file_ktp) }}" alt="{{ $permohonanInformasi->file_ktp }}" width="200px" id="previewImage">
                  </div>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="imageInput" name="file_ktp">
                      <label class="custom-file-label" for="link">Pilih file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                  @error('file_ktp')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  <h4>Detail Permohonan</h4>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="informasi">
                    <h5 class="mb-0">Informasi yang dibutuhkan</h5>
                  </label>
                  <textarea class="w-100 form-control" name="informasi_yang_dibutuhkan" id="informasi" cols="30" required>{{ old('nama') ?? $permohonanInformasi->informasi_yang_dibutuhkan }}</textarea>
                  @error('informasi_yang_dibutuhkan')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="alasan">
                    <h5 class="mb-0">Alasan pengguna Informasi</h5>
                  </label>
                  <textarea class="w-100 form-control" name="alasan_penggunaan_informasi" id="alasan" cols="30" required>{{ old('nama') ?? $permohonanInformasi->alasan_penggunaan_informasi }}</textarea>
                  @error('alasan_penggunaan_informasi')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="memperoleh">
                    <h5 class="mb-0">Memperoleh informasi</h5>
                  </label>
                  <select id="memperoleh" name="memperoleh_informasi_id" class="custom-select" required>
                    <option value=""></option>
                    @foreach ($getInformation as $item)
                      <option value="{{ $item->id }}" {{ $item->id == $permohonanInformasi->memperoleh_informasi_id ?'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                  </select>
                  @error('memperoleh_informasi_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="Mendapatkan">
                    <h5 class="mb-0">Mendapatkan salinan informasi</h5>
                  </label>
                  <select id="Mendapatkan" name="mendapatkan_salinan_informasi_id" class="custom-select" required>
                    <option value=""></option> 
                    @foreach ($copyInformation as $item)        
                     <option value="{{ $item->id }}" {{ $item->id == $permohonanInformasi->mendapatkan_salinan_informasi_id ?'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                  </select>
                  @error('mendapatkan_salinan_informasi_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <a href="/permohonan_informasi" class="btn btn-secondary">kembali</a>
                <button type="submit" class="btn btn-primary">update</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
@endsection
