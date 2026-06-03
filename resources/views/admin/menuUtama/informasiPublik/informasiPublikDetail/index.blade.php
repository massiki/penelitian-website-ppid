@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 d-flex justify-content-between">
            <h1 class="m-0">Informasi Publik Detail</h1>
            @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'operator')
              <a href="/informasi_publik/{{ $informasiPublikId }}/detail/create" class="btn btn-primary"><i class="nav-icon fas fa-plus"></i></a>
            @endif
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
              <h3 class="card-title">Data Informasi Publik Detail</h3>
              <div class="card-tools">
                <form>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="cari" class="form-control float-right" id="searchInput"
                      placeholder="Cari informasi" value="{{ request('cari') }}">
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
              <div class="card-tools">
                <p class="p-3 mb-0"><strong>Ringkasan: </strong>{{ $infoPublik->ringkasan_informasi ?? '' }}</p>
              </div>
              </div>
              <table class="table table-hover text-center">
                <thead>
                  <tr class="text-center">
                    <th class="align-middle">No</th>
                    <th class="align-middle">Informasi</th>
                    <th class="align-middle">Tahun</th>
                    <th class="align-middle">PDF</th>
                    @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'operator')
                      <th class="align-middle">Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($details as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="text-left align-middle">{{ $item->informasi }}</td>
                      <td class="align-middle">{{ $item->tahun }}</td>
                      <td class="align-middle">
                        <button type="button" class="btn btn-info" data-toggle="modal"
                          data-target="#modal-xl{{ $item->id }}">
                          <i class="nav-icon fas fa-download"></i>
                        </button>
                      </td>
                      <td class="align-middle">
                        <div>
                          @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'operator')
                            <a href="/informasi_publik/{{ $informasiPublikId }}/{{ $item->id }}/detail" class="btn btn-warning my-1">
                              <i class="nav-icon fas fa-pencil"></i>
                            </a>
                            <form action="/informasi_publik/{{ $item->id }}/detail" method="post">
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

                    {{-- modal --}}
                    <div class="modal fade" id="modal-xl{{ $item->id }}">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <iframe id="pdfViewer" src="{{ asset('storage/' . $item->link) }}" frameborder="0"
                            style="width: 100%; height: 600px;"></iframe>
                        </div>
                      </div>
                    </div>

                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          {{ $details->links('pagination::bootstrap-5') }}
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
