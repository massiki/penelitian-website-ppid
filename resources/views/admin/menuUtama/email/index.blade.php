@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 d-flex justify-content-between">
            <h1 class="m-0">Email</h1>
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
              <h3 class="card-title">Data Email Permohonan</h3>
              <div class="card-tools">
                <form>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="cari" class="form-control float-right" id="searchInput"
                      placeholder="Cari nama" value="{{ request('cari') }}">
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
                    <th class="align-middle">No</th>
                    <th class="align-middle">ID - Nama</th>
                    <th class="align-middle">Email</th>
                    <th class="align-middle">Informasi</th>
                    <th class="align-middle">Salinan Informasi</th>
                    <th class="align-middle">Status Pengiriman</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($informations as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $item->id }} - {{ $item->nama }}</td>
                      <td class="align-middle">{{ $item->email }}</td>
                      <td class="align-middle">{{ $item->informasi_yang_dibutuhkan }}</td>
                      <td class="align-middle">{{ $item->mendapat->nama }}</td>
                      <td class="align-middle">
                        @if ($item->status_pengiriman == 1)
                          <span class="badge bg-success">terkirim</span>
                        @else
                          <span class="badge bg-warning">belum terkirim</span>
                        @endif
                      </td>
                      <td class="align-middle">
                        <div>
                          @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                            <a href="/email/{{ $item->id }}/send" class="btn btn-primary my-1"><i
                                class="nav-icon fas flaticon-mail"></i></a>
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
          {{ $informations->links('pagination::bootstrap-5') }}

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Email Pengajuan</h3>
              <div class="card-tools">
                <form>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="cari" class="form-control float-right" id="searchInput"
                      placeholder="Cari nama" value="{{ request('cari') }}">
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
                    <th class="align-middle">No</th>
                    <th class="align-middle">ID - Nama</th>
                    <th class="align-middle">Email</th>
                    <th class="align-middle">Tujuan</th>
                    <th class="align-middle">Status Pengiriman</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($submissions as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $item->id }} - {{ $item->nama }}</td>
                      <td class="align-middle">{{ $item->email }}</td>
                      <td class="align-middle">{{ $item->tujuan_penggunaan_informasi }}</td>
                      <td class="align-middle">
                        @if ($item->status_pengiriman == 1)
                          <span class="badge bg-success">terkirim</span>
                        @else
                          <span class="badge bg-warning">belum terkirim</span>
                        @endif
                      </td>
                      <td class="align-middle">
                        <div>
                          @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                            <a href="/email/{{ $item->id }}/send/diterima" class="btn btn-primary my-1"><i
                                class="nav-icon fas flaticon-mail"></i></a>
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
          {{ $submissions->links('pagination::bootstrap-5') }}
          
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
