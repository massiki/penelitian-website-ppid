@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row pt-5">
      <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
        <a href="{{ route('panduan.permohonan') }}">
          <div class="single-contact-card card1">
            <div class="top-part">
              <div class="icon">
                <i class="fal fa-file-alt"></i>
              </div>
              <div class="title">
                <h4>Panduan Permohonan Informasi</h4>
                <span>Klik untuk membaca panduan permohonan informasi</span>
              </div>
            </div>
            <div class="bottom-part">
              <div class="info">
                <p>Silakan baca panduan sebelum mengajukan permohonan informasi di sini.</p>
              </div>
              <a href="{{ route('panduan.permohonan') }}">
                <div class="icon">
                  <i class="fal fa-arrow-right"></i>
                </div>
              </a>
            </div>
          </div>
        </a>
      </div>
      <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
        <a href="{{ route('panduan.pengajuan') }}">
          <div class="single-contact-card card2">
            <div class="top-part">
              <div class="icon">
                <i class="fal fa-file-signature"></i>
              </div>
              <div class="title">
                <h4>Panduan Pengajuan Keberatan</h4>
                <span>Klik untuk membaca panduan pengajuan keberatan</span>
              </div>
            </div>
            <div class="bottom-part">
              <div class="info">
                <p>Jika permohonan Anda ditolak, baca panduan pengajuan keberatan di sini.</p>
              </div>
              <a href="{{ route('panduan.pengajuan') }}">
                <div class="icon">
                  <i class="fal fa-arrow-right"></i>
                </div>
              </a>
            </div>
          </div>
        </a>
      </div>
    </div>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <div class="row pt-5">
      <div class="col-12 col-xl-8 offset-xl-2 text-center">
        <div class="section-title wow fadeInUp">
          <h2>Formulir Permohonan Informasi</h2>
        </div>
      </div>
      <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
        <div class="contact-form">
          <form action="/permohonan/create" method="POST" class="row" id="contact-form" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap"
                  value="{{ old('nama') }}" required>
                @error('nama')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" placeholder="Masukan Alamat Email"
                  value="{{ old('email') }}" required>
                @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="phone">No Telepon <span class="text-danger">*</span></label>
                <input type="text" id="phone" name="no_telepon" placeholder="Masuk no telepon" inputmode="numeric"
                  value="{{ old('no_telepon') }}" oninput="inputPhone()" required>
                @error('no_telepon')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="work">Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" id="work" name="pekerjaan" placeholder="Masukan Pekerjaan"
                  value="{{ old('pekerjaan') }}" required>
                @error('pekerjaan')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="address">Alamat <span class="text-danger">*</span></label>
                <textarea id="address" name="alamat" placeholder="Masukan Alamat" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="nik">NIK <span class="text-danger">*</span></label>
                <input type="text" id="nik" name="nik" placeholder="Masukan identitas"
                  value="{{ old('nik') }}" inputmode="numeric" oninput="inputNik()" required>
                @error('nik')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="formFile" class="form-label">Upload KTP <span class="text-danger">*</span></label>
                <input class="form-control" name="file_ktp" type="file" id="formFile"
                  value="{{ old('file_ktp') }}" required>
                @error('file_ktp')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="information1">Informasi Yang Dibutuhkan <span class="text-danger">*</span></label>
                <textarea id="information1" name="informasi_yang_dibutuhkan" placeholder="Masukan Informasi yang dibutuhkan" required>{{ old('informasi_yang_dibutuhkan') }}</textarea>
                @error('informasi_yang_dibutuhkan')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="information2">Alasan Penggunaan Informasi <span class="text-danger">*</span></label>
                <textarea id="information2" name="alasan_penggunaan_informasi" placeholder="Masukan Alasan Pengguna Informasi" required>{{ old('alasan_penggunaan_informasi') }}</textarea>
                @error('alasan_penggunaan_informasi')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="information3">Cara Memperoleh Informasi <span class="text-danger">*</span></label>
                <select id="information3" name="memperoleh_informasi_id" required>
                  <option value="">Pilih cara memperoleh</option>
                  @foreach ($getInformation as $item)
                    <option value="{{ $item->id }}"
                      {{ old('memperoleh_informasi_id') == $item->id ? 'selected' : '' }}>
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
                <label for="information4">Cara Mendapat Informasi <span class="text-danger">*</span></label>
                <select id="information4" name="mendapatkan_salinan_informasi_id" required>
                  <option value="">Pilih cara mendapat</option>
                  @foreach ($copyInformation as $item)
                    <option value="{{ $item->id }}"
                      {{ old('mendapatkan_salinan_informasi_id') == $item->id ? 'selected' : '' }}>
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
              <div class="input-group mb-3 captcha-wrapper">
                <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror"
                  placeholder="Masukkan Captcha" required>
                <img src="{{ captcha_src('math') }}" alt="captcha">
                @error('captcha')
                  <div class="alert alert-danger invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12 text-center">
              <button class="submit-btn mb-5 mt-4 animated pulse infinite" type="submit">Kirim</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
