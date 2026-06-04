@extends('layouts.app')

@section('content')
  <div class="container py-5">

    {{-- Header --}}
    <div class="text-center mb-5">
      <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3"
        style="font-weight: 500; letter-spacing: 0.3px;">PANDUAN</span>
      <h2 class="fw-bold mb-2" style="color: var(--colorblue2);">Panduan Pengajuan Keberatan</h2>
      <p class="text-muted mx-auto" style="max-width: 560px; font-size: 1.05rem;">
        Pelajari alur, alasan, dan status dalam mengajukan keberatan informasi publik apabila Anda tidak puas terhadap
        hasil permohonan informasi yang telah diberikan oleh PPID.
      </p>
    </div>

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
            Pengajuan keberatan merupakan layanan yang diberikan kepada pemohon informasi apabila tidak puas terhadap
            hasil permohonan informasi yang telah diberikan oleh PPID.
          </p>
        </div>

        {{-- Alasan Pengajuan Keberatan --}}
        <div class="mb-5">
          <div class="d-flex align-items-center gap-2 mb-3">
            <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
            <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Alasan Pengajuan Keberatan</h4>
          </div>
          <ul class="list-unstyled">
            @foreach (['Permohonan informasi ditolak.', 'Informasi yang diberikan tidak sesuai dengan yang diminta.', 'Informasi yang diberikan tidak lengkap.', 'Permohonan tidak ditanggapi dalam jangka waktu yang ditentukan.', 'Terjadi kendala lain dalam pelayanan informasi publik.'] as $reason)
              <li class="d-flex gap-3 py-2 border-bottom border-light">
                <span style="color: var(--colorblue2); flex-shrink: 0;">&#9679;</span>
                <span>{{ $reason }}</span>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- Langkah-Langkah Pengajuan Keberatan --}}
        <div class="mb-5">
          <div class="d-flex align-items-center gap-2 mb-3">
            <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
            <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Langkah-Langkah Pengajuan Keberatan</h4>
          </div>
          @php
            $steps = [
                [
                    'number' => 1,
                    'title' => 'Pastikan Permohonan Informasi Ditolak',
                    'desc' =>
                        'Pastikan Permohonan Informasi Anda ditolak untuk mengisi formulir pengajuan keberatan terhadap permohonan informasi sebelumnya yang diminta.',
                ],
                [
                    'number' => 2,
                    'title' => 'Pilih Menu Permohonan → Pengajuan Keberatan',
                    'desc' => 'Pilih menu <strong>Permohonan &rarr; Pengajuan Keberatan</strong>.',
                ],
                [
                    'number' => 3,
                    'title' => 'Isi Formulir Keberatan',
                    'desc' => 'Isi formulir keberatan dengan lengkap.',
                    'fields' => [
                        'Nama Lengkap',
                        'Email',
                        'No Telephone',
                        'Pekerjaan',
                        'Alamat',
                        'Alasan Pengajuan Keberatan',
                        'Tujuan Penggunaan Informasi',
                    ],
                ],
                [
                    'number' => 4,
                    'title' => 'Kirim Keberatan',
                    'desc' => 'Klik tombol <strong>Kirim Keberatan</strong>.',
                ],
                [
                    'number' => 5,
                    'title' => 'Pemeriksaan oleh Petugas',
                    'desc' =>
                        'Petugas PPID akan melakukan pemeriksaan dan verifikasi terhadap pengajuan keberatan yang diajukan terhadap permohonan informasi sebelumnya.',
                ],
            ];
          @endphp

          <div class="d-flex flex-column gap-3">
            @foreach ($steps as $step)
              <div class="d-flex gap-3 p-4 rounded-3 border" style="background: #fafbfc; transition: all 0.2s ease;"
                onmouseover="this.style.background='#f0f4ff'; this.style.borderColor='#b3d4ff';"
                onmouseout="this.style.background='#fafbfc'; this.style.borderColor='#dee2e6';">
                <div
                  class="d-flex align-items-center justify-content-center rounded-circle fw-bold text-white flex-shrink-0"
                  style="width: 40px; height: 40px; background: var(--colorblue2); font-size: 0.9rem;">
                  {{ $step['number'] }}
                </div>
                <div>
                  <h6 class="fw-semibold mb-2">{{ $step['title'] }}</h6>
                  <p class="text-muted mb-0">{!! $step['desc'] !!}</p>
                  @if (!empty($step['fields'] ?? null))
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

        {{-- Status Pengajuan Keberatan --}}
        <div>
          <div class="d-flex align-items-center gap-2 mb-3">
            <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
            <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Status Pengajuan Keberatan</h4>
          </div>
          <p class="text-muted">Pengajuan keberatan dapat memiliki beberapa status:</p>
          <div class="d-flex flex-wrap gap-3 mb-4">
            @foreach (['Terkirim', 'Diproses', 'Diterima', 'Ditolak', 'Selesai'] as $status)
              <div class="d-flex align-items-center gap-2 px-4 py-2 rounded-3 border" style="background: #fafbfc;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--colorblue2);"></span>
                <span class="fw-medium" style="font-size: 0.95rem;">{{ $status }}</span>
              </div>
            @endforeach
          </div>
          <p class="text-muted">
            Pemohon dapat memantau perkembangan pengajuan keberatan melalui menu <strong>Riwayat Permohonan</strong>.
          </p>
        </div>

      </div>
    </div>
  </div>
@endSection
