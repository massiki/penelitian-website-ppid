@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Permohonan Informasi</h1>
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
              <h3 class="card-title">Data Permohonan Informasi</h3>

              <div class="card-tools">
                <form>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="cari" class="form-control float-right" id="searchInput" placeholder="Cari nama" value="{{ request('cari') }}">
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
                    <th class="align-middle">Informasi yang dibutuhkan</th>
                    <th class="align-middle">Alasan penggunaan informasi</th>
                    <th class="align-middle">Memperoleh informasi</th>
                    <th class="align-middle">Mendapatkan salinan informasi</th>
                    <th class="align-middle">Tanggal Permohonan</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($information as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $item->nama }}</td>
                      <td class="align-middle">{{ $item->informasi_yang_dibutuhkan }}</td>
                      <td class="align-middle">{{ $item->alasan_penggunaan_informasi }}</td>
                      <td class="align-middle">{{ $item->memperoleh->nama }}</td>
                      <td class="align-middle">{{ $item->mendapat->nama }}
                      </td>
                      <td class="align-middle">{{ $item->created_at->locale('id')->translatedFormat('H:i, l, d F Y') }}
                      </td>
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
                          @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                            <a href="/permohonan_informasi/{{ $item->id }}" class="btn btn-primary">
                              @if ($item->status_id == 2)
                                <i class="nav-icon fas fa-arrow-right"></i>
                              @else
                                <i class="nav-icon fas fa-eye"></i>
                              @endif
                            </a>
                            <a href="/permohonan_informasi/{{ $item->id }}/edit"
                              class="btn btn-warning my-1"><i class="nav-icon fas fa-pencil"></i></a>
                            <form action="/permohonan_informasi/{{ $item->id }}" method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="nav-icon fas fa-trash"></i>
                              </button>
                            </form>
                          @else
                            <a href="/permohonan_informasi/{{ $item->id }}" class="btn btn-primary">
                              <i class="nav-icon fas fa-eye"></i>
                            </a>
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
          
          {{ $information->links('pagination::bootstrap-5') }}
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  
@endsection
