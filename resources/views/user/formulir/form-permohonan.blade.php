@extends('layouts.app')

@section('content')
  <div class="container">
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <div class="row pt-5">
      <div class="col-12 col-xl-8 offset-xl-2 text-center">
        <div class="section-title">
          <h2>Formulir Permohonan Informasi</h2>
        </div>
      </div>
      <div class="col-12 col-lg-12">
        <div class="contact-form">
          <form action="/permohonan/create" method="POST" class="row" id="contact-form" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap"
                  value="{{ old('nama') }}">
                @error('nama')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukan Alamat Email"
                  value="{{ old('email') }}">
                @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="phone">No Telepon</label>
                <input type="text" id="phone" name="no_telepon" placeholder="Masuk no telepon" inputmode="numeric"
                  value="{{ old('no_telepon') }}" oninput="inputPhone()">
                @error('no_telepon')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="work">Pekerjaan</label>
                <input type="text" id="work" name="pekerjaan" placeholder="Masukan Pekerjaan"
                  value="{{ old('pekerjaan') }}">
                @error('pekerjaan')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="address">Alamat</label>
                <textarea id="address" name="alamat" placeholder="Masukan Alamat" >{{ old('alamat') }}</textarea>
                @error('alamat')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="nik">NIK</label>
                <input type="text" id="nik" name="nik" placeholder="Masukan identitas" value="{{ old('nik') }}" inputmode="numeric" oninput="inputNik()">
                @error('nik')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="formFile" class="form-label">Upload KTP</label>
                <input class="form-control" name="file_ktp" type="file" id="formFile" value="{{ old('file_ktp') }}">
                @error('file_ktp')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="information1">Informasi Yang Dibutuhkan</label>
                <textarea id="information1" name="informasi_yang_dibutuhkan" placeholder="Masukan Informasi yang dibutuhkan" >{{ old('informasi_yang_dibutuhkan') }}</textarea>
                @error('informasi_yang_dibutuhkan')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="information2">Alasan Penggunaan Informasi</label>
                <textarea id="information2" name="alasan_penggunaan_informasi" placeholder="Masukan Alasan Pengguna Informasi" >{{ old('alasan_penggunaan_informasi') }}</textarea>
                @error('alasan_penggunaan_informasi')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="information3">cara memperoleh informasi</label>
                <select id="information3" name="memperoleh_informasi_id" >
                  <option value=""></option>
                  @foreach ($getInformation as $item)
                    <option value="{{ $item->id }}" {{ old('memperoleh_informasi_id') == $item->id ? 'selected' : '' }}>
                      {{ $item->nama }}
                    </option>
                  @endforeach
                </select>
                @error('memperoleh_informasi_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="information4">cara mendapat informasi</label>
                <select id="information4" name="mendapatkan_salinan_informasi_id">
                  <option></option>
                  @foreach ($copyInformation as $item)
                    <option value="{{ $item->id }}" {{ old('mendapatkan_salinan_informasi_id') == $item->id ? 'selected' : '' }}>
                      {{ $item->nama }}
                    </option>
                  @endforeach
                </select>
                @error('mendapatkan_salinan_informasi_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="input-group mb-3">
                <div class="mt-2"></div>
                <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="Please Insert Captch">
                <img src="{{ captcha_src('math') }}" alt="captcha">
                @error('captcha') 
                  <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                @enderror 
              </div>
            </div>
            <div class="col-md-12 col-12 text-center">
              <button class="submit-btn mb-5 mt-4" type="submit">Kirim</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
