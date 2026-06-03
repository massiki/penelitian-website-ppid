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
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pengajuan Keberatan</h3>
              <div class="card-tools">
                <form>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="cari" class="form-control float-right" id="searchInput"
                      placeholder="Cari nama" name="cari" value="{{ request('cari') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="align-middle">no</th>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle">Tujuan Penggunaan Informasi</th>
                    <th class="align-middle">Alasan penggunaan informasi</th>
                    <th class="align-middle">Tanggal Pengajuan</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($submission as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $item->nama }}</td>
                      <td class="align-middle">{{ $item->tujuan_penggunaan_informasi }}</td>
                      <td class="align-middle">{{ $item->pengajuan->nama }} </td>
                      <td class="align-middle">{{ $item->created_at->locale('id')->translatedFormat('H:i, l, d F Y') }}</td>
                      <td class="align-middle">
                        @if ($item->status_id == 2)
                          <span class="badge bg-warning">belum dibuka</span>
                        @elseif ($item->status_id == 3)
                          <span class="badge bg-info">{{ $item->status->status }}</span>
                        @elseif ($item->status_id == 0)
                          <span class="badge bg-danger">{{ $item->status->status }}</span>
                        @elseif ($item->status_id == 1)
                          <span class="badge bg-success">{{ $item->status->status }}</span>
                        @endif
                      </td>
                      <td class="align-middle">
                        <div class="">
                          <a href="/pengajuan_keberatan/{{ $item->id }}" class="btn btn-primary">
                            @if ($item->status_id == 2)
                              <i class="nav-icon fas fa-arrow-right"></i>
                            @else
                              <i class="nav-icon fas fa-eye"></i>
                            @endif
                          </a>
                          @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                            <a href="/pengajuan_keberatan/{{ $item->id }}/edit" class="btn btn-warning my-1">
                              <i class="nav-icon fas fa-pencil"></i>
                            </a>
                            <form action="/pengajuan_keberatan/{{ $item->id }}" method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="nav-icon fas fa-trash"></i></button>
                            </form>
                          @endif
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          {{ $submission->links('pagination::bootstrap-5') }}
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
