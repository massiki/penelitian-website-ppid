@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengajuan Keberatan</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
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
              <div>
                <h5 class="mb-0">Nama Lengkap</h5>
                <p>{{ $item->nama }}</p>
              </div>
              <div>
                <h5 class="mb-0">Email</h5>
                <p>{{ $item->email }}</p>
              </div>
              <div>
                <h5 class="mb-0">Telepon</h5>
                <p>{{ $item->no_telepon }}</p>
              </div>
              <div>
                <h5 class="mb-0">Pekerjaan</h5>
                <p>{{ $item->pekerjaan }}</p>
              </div>
              <div>
                <h5 class="mb-0">Alamat</h5>
                <p>{{ $item->alamat }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                <h4>Detail Pengajuan</h4>
              </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-3">
              <div>
                <h5 class="mb-0">Tujuan Informasi</h5>
                <p>{{ $item->tujuan_penggunaan_informasi }}</p>
              </div>
              <div>
                <h5 class="mb-0">Alasan Pengajuan</h5>
                <p>{{ $item->pengajuan->nama }}</p>
              </div>
              <div>
                <h5 class="mb-0">Tanggal Permohonan</h5>
                <p>{{ $item->created_at->locale('id')->translatedFormat('H:i, l, d F Y') }}</p>
              </div>
              @if ($item->status_id == 2)
                <div class="alert alert-warning text-uppercase text-center">Status belum dibuka</div>
              @elseif ($item->status_id == 3)
                <div class="alert alert-primary text-uppercase text-center">Status {{ $item->status->status }}</div>
              @elseif ($item->status_id == 0)
                <div class="alert alert-danger text-uppercase text-center">Status {{ $item->status->status }}</div>
              @elseif ($item->status_id == 1)
                <div class="alert alert-success text-uppercase text-center">Status {{ $item->status->status }}
                </div>
              @endif

              @if ($item->status_id == 3)
                @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                  <form action="/pengajuan_keberatan/{{ $item->id }}/tolak" method="post" class="d-inline">
                    @csrf
                    @method('patch')
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tolak">
                      Tolak <i class="nav-icon fas fa-window-close"></i>
                    </button>
                  </form>
                  <form action="/pengajuan_keberatan/{{ $item->id }}/terima" method="post" class="d-inline">
                    @csrf
                    @method('patch')
                    <button type="submit" class="btn btn-success"
                      onclick="return confirm('Apakah anda yakin ingin menerima pengajuan ini?')">Terima <i
                        class="nav-icon fas fa-check"></i></button>
                  </form>
                @endif
              @elseif ($item->status_id == 0)
                @if ($item->pesan_ditolak)
                  <div>
                    <h5 class="mb-0">Alasan Ditolak</h5>
                    <p>{{ $item->pesan_ditolak }}</p>
                  </div>
                  @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                    <a href="/email/{{ $item->id }}/send/ditolak" class="btn btn-primary my-1">
                      @if ($item->status_pengiriman == 0)
                        Kirim Email
                      @else
                        Kirim Email lagi
                      @endif
                    </a>
                  @endif
                @endif
              @elseif ($item->status_id == 1)
                @if ($item->file_acc_pengajuan == null)
                  @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                    <div class="table-responsive">
                      <div>
                        <form action="/pengajuan_keberatan/{{ $item->id }}/upload" method="post"
                          enctype="multipart/form-data">
                          @csrf
                          @method('patch')
                          <div>
                            <h5 class="mb-2">File</h5>
                            <div class="input-group mb-2">
                              <div id="iframeContainer" style="display: none;">
                                <iframe src="" frameborder="0" id="previewImage"></iframe>
                              </div>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="imageInput"
                                    name="file_acc_pengajuan" onchange="showIframe()">
                                  <label class="custom-file-label" for="link">Pilih file</label>
                                </div>
                                <div class="input-group-append">
                                  <span class="input-group-text">Upload PDF</span>
                                </div>
                              </div>
                              @error('file_acc_pengajuan')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                      </div>
                    </div>
                  @endif
                @else
                  <div>
                    <h5 class="mb-0">File</h5>
                    <div class="d-flex">
                      <div>
                        <button type="button" class="btn btn-info" data-toggle="modal"
                          data-target="#modal-xl{{ $item->id }}">
                          Klik Disini <i class="nav-icon fas fa-download"></i>
                        </button>
                        {{-- modal --}}
                        <div class="modal fade" id="modal-xl{{ $item->id }}">
                          <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                              <div class="modal-header">
                                {{-- <h4 class="modal-title">Extra Large Modal</h4> --}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <iframe id="pdfViewer" src="{{ asset('storage/' . $item->file_acc_pengajuan) }}#toolbar=0"
                                frameborder="0" style="width: 100%; height: 600px;"></iframe>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                      </div>
                      @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                        <div>
                          <a href="/email/{{ $item->id }}/send/diterima" class="btn btn-primary ml-1">
                            @if ($item->status_pengiriman == 0)
                              Kirim Email
                            @else
                              Kirim Email lagi
                            @endif
                          </a>
                        </div>
                      @endif
                    </div>
                  </div>
                @endif
              @endif

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  {{-- Modal --}}
  <div class="modal fade" id="tolak">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Alasan Pesan Ditolak</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/pengajuan_keberatan/{{ $item->id }}/tolak" method="post">
          <div class="modal-body">
            @csrf
            @method('patch')
            <textarea name="pesan_ditolak" id="pesan_ditolak" class="form-control mb-2"
              placeholder="Masukkan alasan pesan ditolak"></textarea>
            @error('pesan_ditolak')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Tolak</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
