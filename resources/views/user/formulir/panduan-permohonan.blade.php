@extends('layouts.app')

@section('content')
  <div class="container py-5">

    {{-- Header --}}
    <div class="text-center mb-5 wow fadeInUp">
      <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3"
        style="font-weight: 500; letter-spacing: 0.3px;">PANDUAN</span>
      <h2 class="fw-bold mb-2" style="color: var(--colorblue2);">{{ $panduan->judul }}</h2>
      <p class="text-muted mx-auto" style="max-width: 560px; font-size: 1.05rem;">
        {{ $panduan->deskripsi }}
      </p>
    </div>

    {{-- Media --}}
    <div class="row g-4 mb-5">
      <div class="col-md-6 wow fadeInLeft">
        <div class="rounded-3 overflow-hidden shadow-sm h-100">
          <img src="{{ $panduan->gambar ? asset('storage/' . $panduan->gambar) : asset('assets/img/sop-ppid.png') }}"
            alt="Panduan Permohonan Informasi" class="img-fluid w-100 h-100" style="object-fit: cover;">
        </div>
      </div>
      <div class="col-md-6 wow fadeInRight">
        <div class="rounded-3 overflow-hidden shadow-sm h-100 bg-light d-flex align-items-center">
          <video class="w-100" controls style="aspect-ratio: 16 / 9;">
            <source
              src="{{ $panduan->video_url ?? 'https://ppid-simonik.bandung.go.id/assets/img/videomekanismepelayanan.mp4' }}"
              type="video/mp4">
            Browser Anda tidak mendukung tag video.
          </video>
        </div>
      </div>
    </div>

    {{-- Content --}}
    <div class="row justify-content-center">
      <div class="col-lg-8">

        {{-- Description --}}
        <div class="mb-5 wow fadeInUp">
          <p class="text-muted" style="font-size: 1.05rem; line-height: 1.8;">
            {!! $panduan->deskripsi_konten !!}
          </p>
        </div>

        {{-- Persyaratan --}}
        @if ($panduan->persyaratan)
          <div class="mb-5 wow fadeInUp">
            <div class="d-flex align-items-center gap-2 mb-3">
              <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
              <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Persyaratan Permohonan Informasi</h4>
            </div>
            <ul class="list-unstyled">
              @foreach ($panduan->persyaratan as $item)
                <li class="d-flex gap-3 py-2 border-bottom border-light">
                  <span style="color: var(--colorblue2); flex-shrink: 0;">✓</span>
                  <span>{{ $item }}</span>
                </li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- Langkah-langkah --}}
        @if ($panduan->langkah)
          <div class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-4 wow fadeInUp">
              <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
              <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Langkah-Langkah Permohonan Informasi</h4>
            </div>

            <div class="d-flex flex-column gap-3">
              @foreach ($panduan->langkah as $i => $step)
                <div class="d-flex gap-3 p-4 rounded-3 border wow fadeInUp" data-wow-delay="{{ 0.1 + $i * 0.1 }}s"
                  style="background: #fafbfc; transition: all 0.2s ease;"
                  onmouseover="this.style.background='#f0f4ff'; this.style.borderColor='#b3d4ff';"
                  onmouseout="this.style.background='#fafbfc'; this.style.borderColor='#dee2e6';">
                  <div
                    class="d-flex align-items-center justify-content-center rounded-circle fw-bold text-white flex-shrink-0"
                    style="width: 40px; height: 40px; background: var(--colorblue2); font-size: 0.9rem;">
                    {{ $i + 1 }}
                  </div>
                  <div>
                    <h6 class="fw-semibold mb-2">{{ $step['judul'] }}</h6>
                    <p class="text-muted mb-0">{!! $step['deskripsi'] !!}</p>
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
        @endif

        {{-- Status Permohonan --}}
        @if ($panduan->status_list)
          <div class="wow fadeInUp">
            <div class="d-flex align-items-center gap-2 mb-3">
              <div style="width: 4px; height: 24px; background: var(--colorblue2); border-radius: 2px;"></div>
              <h4 class="fw-semibold mb-0" style="color: var(--colorblue2);">Status Permohonan</h4>
            </div>
            <p class="text-muted">Permohonan yang diajukan dapat memiliki beberapa status:</p>
            <div class="d-flex flex-wrap gap-3 mb-4">
              @foreach ($panduan->status_list as $status)
                <div class="d-flex align-items-center gap-2 px-4 py-2 rounded-3 border" style="background: #fafbfc;">
                  <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--colorblue2);"></span>
                  <span class="fw-medium" style="font-size: 0.95rem;">{{ $status }}</span>
                </div>
              @endforeach
            </div>
            <p class="text-muted">
              Pemohon dapat melihat perkembangan status melalui menu <strong>Riwayat Permohonan</strong> sesuai dengan
              email
              yang diisi.
            </p>
          </div>
        @endif
      </div>
    </div>
  </div>
@endSection
