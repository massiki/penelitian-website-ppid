@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row pt-5">
      <div class="col-12 col-md-6">
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
      <div class="col-12 col-md-6">
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
    <div class="row pt-5">
      <div class="col-12 text-center">
        <div class="section-title">
          <h2>Formulir Pengajuan Keberatan Informasi</h2>
        </div>
      </div>

      <div class="col-12 col-lg-12">
        <div class="contact-form">
          <form action="/pengajuan/create" class="row" id="contact-form" method="POST">
            @csrf
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" id="name" placeholder="Masukan Nama Lengkap" name="nama"
                  value="{{ old('nama') ?? ($applicant->nama ?? '') }}" required>
                @error('nama')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="email">Alamat Email <span class="text-danger">*</span></label>
                <input type="email" id="email" placeholder="Masukan Alamat Email" name="email"
                  value="{{ old('email') ?? ($applicant->email ?? '') }}" required>
                @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="phone">No Telepon <span class="text-danger">*</span></label>
                <input type="text" id="phone" placeholder="Masuk no telepon" name="no_telepon"
                  value="{{ old('no_telepon') ?? ($applicant->no_telepon ?? '') }}" oninput="inputPhone()" required>
                @error('no_telepon')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="work">Pekerjaan <span class="text-danger">*</span></label>
                <input type="text" id="work" placeholder="Masukan Pekerjaan" name="pekerjaan"
                  value="{{ old('pekerjaan') ?? ($applicant->pekerjaan ?? '') }}" required>
                @error('pekerjaan')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="address">Alamat <span class="text-danger">*</span></label>
                <textarea id="address" placeholder="Masukan Alamat" name="alamat" required>{{ old('alamat') ?? ($applicant->alamat ?? '') }}</textarea>
                @error('alamat')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-5">
                <label for="information2">Alasan Pengajuan Keberatan <span class="text-danger">*</span></label>
                <select id="kuasa" name="alasan_pengajuan_id" required>
                  <option value="">Pilih alasan</option>
                  @foreach ($reason as $item)
                    <option value="{{ $item->id }}" {{ old('alasan_pengajuan_id') == $item->id ? 'selected' : '' }}>
                      {{ $item->nama }}
                    </option>
                  @endforeach
                </select>
                @error('alasan_pengajuan_id')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="information1">Tujuan Penggunaan Informasi <span class="text-danger">*</span></label>
                <textarea id="information1" placeholder="Masukan Tujuan Penggunaan Informasi" name="tujuan_penggunaan_informasi" required>{{ old('tujuan_penggunaan_informasi') }}</textarea>
                @error('tujuan_penggunaan_informasi')
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
              <button class="submit-btn mb-5" type="submit">Kirim</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
