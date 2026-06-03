@extends('layouts.app')

@section('content')

  <div class="section-title text-center pt-5">
    <h2>Riwayat Permohonan Informasi</h2>
  </div>
  <div class="col-12 col-lg-6 offset-lg-3 pt-5 mt-5 mb-5 ">
    <div class="main-sidebar">
      <div class="single-sidebar-widget ">
        <div class="text-center">
          <h3>Cari Permohonan</h3>
        </div>
        <div class="search_widget">
          <form action="{{ route('riwayat') }}" method="get">
            <input type="email" name="email" placeholder="Masukan Email ..." value="{{ request('email') }}">
            <button type="submit"><i class="fal fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container mb-5">
    <div class="accordion" id="accordionExample">
      @if ($information)
        @foreach ($information as $key => $item)
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $key }}" aria-expanded="false"
                aria-controls="collapse{{ $key }}">
                {{ $key + 1 }}. {{ Str::limit($item->informasi_yang_dibutuhkan, 50, '...') }}
              </button>
            </h2>
            <div id="collapse{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                      <div class="mb-3">
                        <h5 class="mb-0">Nama Lengkap</h5>
                        <p>{{ $item->nama }}</p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">Email</h5>
                        <p>{{ $item->email }}</p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">Telepon</h5>
                        <p>
                          {{ substr_replace($item->no_telepon, str_repeat('*', strlen($item->no_telepon) - 8), 4, strlen($item->no_telepon) - 8) }}
                        </p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">Pekerjaan</h5>
                        <p>{{ $item->pekerjaan }}</p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">Alamat</h5>
                        <p>{{ $item->alamat }}</p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">NIK</h5>
                        <p>
                          {{ substr_replace($item->nik, str_repeat('*', strlen($item->nik) - 8), 4, strlen($item->nik) - 8) }}
                        </p>
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
                      <div class="mb-3">
                        <h5 class="mb-0">Informasi Yang Dibutuhkan</h5>
                        <p>{{ $item->informasi_yang_dibutuhkan }}</p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">Alasan Penggunaan Informasi</h5>
                        <p> {{ $item->alasan_penggunaan_informasi }}</p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">Memperoleh Informasi</h5>
                        <p>{{ $item->memperoleh->nama }}</p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">Mendapatkan Salinan Informasi</h5>
                        <p>{{ $item->mendapat->nama }}</p>
                      </div>
                      <div class="mb-3">
                        <h5 class="mb-0">Tanggal Permohonan</h5>
                        <p>{{ $item->created_at->locale('id')->translatedFormat('H:i, l, d F Y') }}</p>
                      </div>
                      @if ($item->status_id == 2)
                        <div class="alert alert-secondary text-uppercase text-center">Status {{ $item->status->status }}
                        </div>
                      @elseif ($item->status_id == 3)
                        <div class="alert alert-primary text-uppercase text-center">Status {{ $item->status->status }}
                        </div>
                      @elseif ($item->status_id == 0)
                        <div class="alert alert-danger text-uppercase text-center">Status {{ $item->status->status }}
                        </div>
                      @elseif ($item->status_id == 1)
                        <div class="alert alert-success text-uppercase text-center">Status {{ $item->status->status }}
                        </div>
                      @endif
                      <div class="ms-3">
                        <ul class="timeline-list">
                          <li class="circle active">
                            <div class="content ">
                              <h4>Terkirim</h4>
                              <p>
                                Permohonan informasi telah berhasil dikirim dan diterima oleh PPID. Verifikasi data
                                pemohon sedang dilakukan
                                untuk memulai proses.
                              </p>
                            </div>
                          </li>
                          <li class="circle @if ($item->status_id != 2) active @endif">
                            <div class="content">
                              <h4>Diproses</h4>
                              <p>
                                PPID sedang meninjau permohonan dan memverifikasi informasi yang dapat diberikan. Jika
                                diperlukan, klarifikasi
                                tambahan akan dilakukan.
                              </p>
                            </div>
                          </li>
                          <li class="circle @if ($item->status_id == 0 || $item->status_id == 1) active @endif">
                            <div class="content">
                              <h4>Selesai</h4>
                              <p>
                                Proses permohonan telah selesai, dan informasi yang diminta sudah disiapkan. Pemohon akan
                                segera menerima hasil sesuai dengan ketentuan.
                              </p>
                            </div>
                          </li>
                        </ul>
                      </div>
                      @if ($item->status_id == 0)
                        <div class="mb-3">
                          <h5 class="mb-0">Alasan Ditolak</h5>
                          <p>{{ $item->pesan_ditolak }}</p>
                          <form action="/pengajuan">
                            <input type="hidden" name="pemohon" value="{{ encrypt($item->id) }}">
                            <button type="submit" class="btn btn-primary">Ajukan Keberatan</button>
                          </form>
                        </div>
                      @elseif ($item->status_id == 1)
                        <div class="mb-3">
                          <h5 class="mb-0">Permohonan Diterima</h5>
                          @if ($item->mendapatkan_salinan_informasi_id == 4 && $item->file_acc_permohonan == null)
                            <p>Mohon menunggu untuk pembuatan file PDF</p>
                          @elseif ($item->mendapatkan_salinan_informasi_id == 4 && $item->file_acc_permohonan)
                            @if (App\Models\Rating::where('permohonan_informasi_id', $item->id)->first())
                              <p>Silahkan ambil permohonan di RSUD Kesehatan Kerja</p>
                              <p>Terima kasih sudah memberikan ulasan</p>
                            @else
                              <p>Silahkan ambil permohonan di RSUD Kesehatan Kerja</p>
                              <p>Berikan rating sebelum mengambil</p>
                              <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#rating">
                                Masuk ulasan
                              </button>
                              {{-- Modal --}}
                              <div class="modal fade" id="rating" tabindex="-1" aria-labelledby="ModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="ModalLabel">Berikan ulasan</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    </div>
                                    <form action="/rating" method="post">
                                      @csrf
                                      <div class="modal-body text-center">
                                        <div class="rating">
                                          <span class="star" style="font-size: 36px; cursor: pointer;"
                                            onclick="setRating(1)">&#9733;</span>
                                          <span class="star" style="font-size: 36px; cursor: pointer;"
                                            onclick="setRating(2)">&#9733;</span>
                                          <span class="star" style="font-size: 36px; cursor: pointer;"
                                            onclick="setRating(3)">&#9733;</span>
                                          <span class="star" style="font-size: 36px; cursor: pointer;"
                                            onclick="setRating(4)">&#9733;</span>
                                          <span class="star" style="font-size: 36px; cursor: pointer;"
                                            onclick="setRating(5)">&#9733;</span>
                                        </div>
                                        <input type="hidden" id="ratingValue" value="{{ old('star') }}"
                                          name="star" name="star">
                                        @error('star')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <textarea id="reviewText" rows="4" class="form-control mt-3" placeholder="Tulis ulasan Anda di sini..."
                                          name="comment">{{ old('comment') }}</textarea>
                                        @error('comment')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="sumbit" class="btn btn-primary">Posting</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            @endif
                          @elseif ($item->mendapatkan_salinan_informasi_id == 5 && $item->file_acc_permohonan == null)
                            <p>Mohon menunggu untuk pembuatan file PDF</p>
                          @elseif ($item->mendapatkan_salinan_informasi_id == 5 && $item->file_acc_permohonan)
                            @if ($item->status_pengiriman)
                              <p>File sudah dikirim ke alamat email anda.</p>
                            @else
                              <p>File masih dalam proses pengiriman ke email anda.</p>
                            @endif
                          @endif
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        {{ $information->links('pagination::bootstrap-5') }}
      @endif
    </div>
  </div>


@endsection
