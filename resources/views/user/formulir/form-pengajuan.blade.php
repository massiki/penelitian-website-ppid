@extends('layouts.app')

@section('content')
  <div class="container">
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
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" placeholder="Masukan Nama Lengkap" name="nama" 
                  value="{{ old('nama') ?? ($applicant->nama ?? '') }}">
                @error('nama')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" placeholder="Masukan Alamat Email" name="email" 
                  value="{{ old('email') ?? ($applicant->email ?? '') }}">
                @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="phone">No Telepon</label>
                <input type="text" id="phone" placeholder="Masuk no telepon" name="no_telepon" 
                  value="{{ old('no_telepon') ?? ($applicant->no_telepon ?? '') }}"
                  oninput="inputPhone()">
                @error('no_telepon')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="single-personal-info">
                <label for="work">Pekerjaan</label>
                <input type="text" id="work" placeholder="Masukan Pekerjaan" name="pekerjaan" 
                  value="{{ old('pekerjaan') ?? ($applicant->pekerjaan ?? '') }}">
                @error('pekerjaan')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-0">
                <label for="address">Alamat</label>
                <textarea id="address" placeholder="Masukan Alamat" name="alamat" >{{ old('alamat') ?? ($applicant->alamat ?? '') }}</textarea>
                @error('alamat')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="single-personal-info mb-5">
                <label for="information2">Alasan Pengajuan Keberatan</label>
                <select id="kuasa" name="alasan_pengajuan_id" >
                  <option></option>
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
                <label for="information1">Tujuan Penggunaan Informasi</label>
                <textarea id="information1" placeholder="Masukan Tujuan Penggunaan Informasi" name="tujuan_penggunaan_informasi" >{{ old('tujuan_penggunaan_informasi') }}</textarea>
                @error('tujuan_penggunaan_informasi')
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
              <input class="submit-btn mb-5" type="submit" value="Kirim">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
