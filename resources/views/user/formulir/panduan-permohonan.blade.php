@extends('layouts.app')

@section('content')
  <div class="container py-5">

    {{-- Header --}}
    <div class="text-center mb-5">
      <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3"
        style="font-weight: 500; letter-spacing: 0.3px;">PANDUAN</span>
      <h2 class="fw-bold mb-2" style="color: var(--colorblue2);">Panduan Permohonan Informasi</h2>
      <p class="text-muted mx-auto" style="max-width: 560px; font-size: 1.05rem;">
        Pelajari alur dan persyaratan sebelum mengajukan permohonan informasi publik.
      </p>
    </div>

    {{-- Media --}}
    <div class="row g-4 mb-5">
      <div class="col-md-6">
        <div class="rounded-3 overflow-hidden shadow-sm h-100">
          <img src="{{ asset('assets/img/sop-ppid.png') }}" alt="Panduan Permohonan Informasi"
            class="img-fluid w-100 h-100" style="object-fit: cover;">
        </div>
      </div>
      <div class="col-md-6">
        <div class="rounded-3 overflow-hidden shadow-sm h-100 bg-light d-flex align-items-center">
          <video class="w-100" controls style="aspect-ratio: 16 / 9;">
            <source src="https://ppid-simonik.bandung.go.id/assets/img/videomekanismepelayanan.mp4" type="video/mp4">
            Browser Anda tidak mendukung tag video.
          </video>
        </div>
      </div>
    </div>

    {{-- Content --}}
    <div class="row justify-content-center">
      <div class="col-lg-8">

        {{-- Description --}}
        <div class="mb-5">
          <p class="text-muted" style="font-size: 1.05rem; line-height: 1.8;">
            Permohonan Informasi adalah layanan yang diberikan kepada masyarakat untuk memperoleh informasi publik yang
            berada di bawah penguasaan RSUD Kesehatan Kerja sesuai dengan peraturan perundang-undangan yang berlaku.
          </p>
        </div>

        {{-- Persyaratan --}}
        <div class="mb-5">
          <div class="d-flex align-items-center gap-2 mb-3">
            <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
            <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Persyaratan Permohonan Informasi</h4>
          </div>
          <ul class="list-unstyled">
            @foreach ([
                'Mengisi data-data pribadi.',
                'Foto Kartu Tanda Penduduk (KTP) yang masih berlaku.',
                'Informasi yang ingin diminta secara jelas dan rinci.',
                'Email atau nomor telepon yang dapat dihubungi.',
            ] as $item)
              <li class="d-flex gap-3 py-2 border-bottom border-light">
                <span style="color: var(--colorblue2); flex-shrink: 0;">✓</span>
                <span>{{ $item }}</span>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- Langkah-langkah --}}
        <div class="mb-5">
          <div class="d-flex align-items-center gap-2 mb-4">
            <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
            <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Langkah-Langkah Permohonan Informasi</h4>
          </div>

          @php
            $steps = [
                [
                    'title' => 'Klik Menu Permohonan Informasi',
                    'desc' => 'Klik menu <strong>Permohonan &rarr; Permohonan Informasi</strong> pada website PPID.',
                ],
                [
                    'title' => 'Isi Formulir Permohonan',
                    'desc' => 'Isi formulir permohonan informasi dengan lengkap dan benar.',
                    'fields' => ['Nama Lengkap', 'Email', 'Nomor Telepon', 'Pekerjaan', 'Alamat', 'NIK', 'Foto KTP', 'Informasi yang Dibutuhkan', 'Alasan Penggunaan Informasi'],
                ],
                [
                    'title' => 'Kirim Permohonan',
                    'desc' => 'Periksa kembali data yang telah diisi kemudian klik tombol <strong>Kirim Permohonan</strong>.',
                ],
                [
                    'title' => 'Verifikasi oleh Petugas',
                    'desc' => 'Petugas PPID akan melakukan verifikasi data dan memproses permohonan informasi sesuai ketentuan yang berlaku.',
                ],
            ];
          @endphp

          <div class="d-flex flex-column gap-3">
            @foreach ($steps as $i => $step)
              <div class="d-flex gap-3 p-4 rounded-3 border"
                style="background: #fafbfc; transition: all 0.2s ease;"
                onmouseover="this.style.background='#f0f4ff'; this.style.borderColor='#b3d4ff';"
                onmouseout="this.style.background='#fafbfc'; this.style.borderColor='#dee2e6';">
                <div class="d-flex align-items-center justify-content-center rounded-circle fw-bold text-white flex-shrink-0"
                  style="width: 40px; height: 40px; background: var(--colorblue2); font-size: 0.9rem;">
                  {{ $i + 1 }}
                </div>
                <div>
                  <h6 class="fw-semibold mb-2">{{ $step['title'] }}</h6>
                  <p class="text-muted mb-0">{!! $step['desc'] !!}</p>
                  @if (!empty($step['fields']))
                    <div class="mt-2">
                      <div class="d-flex flex-wrap gap-2">
                        @foreach ($step['fields'] as $field)
                          <span class="badge bg-light text-dark border px-3 py-2" style="font-weight: 400;">
                            {{ $field }}
                          </span>
                        @endforeach
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>

        {{-- Status Permohonan --}}
        <div>
          <div class="d-flex align-items-center gap-2 mb-3">
            <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
            <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Status Permohonan</h4>
          </div>
          <p class="text-muted">Permohonan yang diajukan dapat memiliki beberapa status:</p>
          <div class="d-flex flex-wrap gap-3 mb-4">
            @foreach (['Terkirim', 'Diproses', 'Diterima', 'Ditolak', 'Selesai'] as $status)
              <div class="d-flex align-items-center gap-2 px-4 py-2 rounded-3 border"
                style="background: #fafbfc;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--colorblue2);"></span>
                <span class="fw-medium" style="font-size: 0.95rem;">{{ $status }}</span>
              </div>
            @endforeach
          </div>
          <p class="text-muted">
            Pemohon dapat melihat perkembangan status melalui menu <strong>Riwayat Permohonan</strong> sesuai dengan email
            yang diisi.
          </p>
        </div>

      </div>
    </div>
  </div>
@endSection
