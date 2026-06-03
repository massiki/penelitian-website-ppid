@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengajuan Keberatan Edit</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form action="/pengajuan_keberatan/{{ $pengajuanKeberatan->id }}" method="post">
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
                  <input class="w-100 form-control" type="text" value="{{ old('nama') ?? $pengajuanKeberatan->nama }} "
                    id="nama_lengkap" name="nama" required>
                  @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="email">
                    <h5 class="mb-0">Email</h5>
                  </label>
                  <input class="w-100 form-control" type="email"
                    value="{{ old('email') ?? $pengajuanKeberatan->email }}" id="email" name="email" required>
                  @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="phone">
                    <h5 class="mb-0">Telepon</h5>
                  </label>
                  <input class="w-100 form-control" type="text"
                    value="{{ old('no_telepon') ?? $pengajuanKeberatan->no_telepon }}" id="phone" name="no_telepon"
                    inputmode="numeric" oninput="inputPhone()" required>
                  @error('no_telepon')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="pekerjaan">
                    <h5 class="mb-0">Pekerjaan</h5>
                  </label>
                  <input class="w-100 form-control" type="text"
                    value="{{ old('pekerjaan') ?? $pengajuanKeberatan->pekerjaan }}" id="pekerjaan" name="pekerjaan"
                    required>
                  @error('pekerjaan')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="alamat">
                    <h5 class="mb-0">Alamat</h5>
                  </label>
                  <textarea class="w-100 form-control" name="alamat" cols="30" id="alamat" required>{{ old('alamat') ?? $pengajuanKeberatan->alamat }}</textarea>
                  @error('alamat')
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
                  <h4>Detail pengajuan keberatan</h4>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-3">
                <div class="mb-4">
                  <label for="informasi">
                    <h5 class="mb-0">tujuan penggunaan informasi</h5>
                  </label>
                  <textarea class="w-100 form-control" name="tujuan_penggunaan_informasi" id="informasi" cols="30" required>{{ old('tujuan_penggunaan_informasi') ?? $pengajuanKeberatan->tujuan_penggunaan_informasi }}</textarea>
                  @error('tujuan_penggunaan_informasi')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <label for="memperoleh">
                    <h5 class="mb-0">Alasan pengajuan keberatan</h5>
                  </label>
                  <select id="alasan" name="alasan_pengajuan_id" class="w-100 form-control" required>
                    <option value=""></option>
                    @foreach ($reason as $item)
                      <option value="{{ $item->id }}"
                        {{ $item->id == $pengajuanKeberatan->alasan_pengajuan_id ? 'selected' : '' }}>
                        {{ $item->nama }}
                      </option>
                    @endforeach
                  </select>
                  @error('alasan_pengajuan_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <a href="/pengajuan_keberatan" class="btn btn-secondary">kembali</a>
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
