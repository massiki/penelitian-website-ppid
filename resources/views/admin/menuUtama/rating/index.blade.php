@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 d-flex justify-content-between">
            <h1 class="m-0">Rating</h1>
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
              <h3 class="card-title">Data Rating</h3>

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
                    <th class="align-middle">Pekerjaan</th>
                    <th class="align-middle">Ulasan</th>
                    <th class="align-middle">Rating</th>
                    <th class="align-middle">Status Posting</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($ratings as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="text-left align-middle">{{ $item->pemohon->id }} - {{ $item->pemohon->nama }}</td>
                      <td class="align-middle">{{ $item->pemohon->pekerjaan }}</td>
                      <td class="align-middle">{{ $item->comment }}</td>
                      <td class="align-middle">
                        @for ($i = 0; $i < $item->star; $i++)
                          <i class="fas fa-star" style="color: #FFD43B;"></i>
                        @endfor
                      </td>
                      <td class="align-middle">
                        @if ($item->status_post == 1)
                          <span class="badge bg-warning">belum diposting</span>
                        @elseif ($item->status_post == 0)
                          <span class="badge bg-danger">tidak diposting</span>
                        @elseif ($item->status_post == 2)
                        <span class="badge bg-primary">diposting</span>
                        @endif
                      </td>
                      <td class="align-middle">
                        <div>
                          @if (Auth::user()->role == 'super_admin')
                            @if ($item->status_post == 1)
                              <form action="/rating/{{ $item->id }}/post" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary my-1"><i class="fas fa-file-check"></i></button>
                              </form>
                              <form action="/rating/{{ $item->id }}/notpost" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger my-1"><i class="fas fa-file-times"></i></button>
                              </form>
                            @elseif ($item->status_post == 0)
                              <form action="/rating/{{ $item->id }}/post" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary my-1"><i class="fas fa-file-check"></i></button>
                              </form>
                            @elseif ($item->status_post == 2)
                              <form action="/rating/{{ $item->id }}/notpost" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger my-1"><i class="fas fa-file-times"></i></button>
                              </form>
                            @endif
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

          {{ $ratings->links('pagination::bootstrap-5') }}
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
