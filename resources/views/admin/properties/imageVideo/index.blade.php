@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 d-flex justify-content-between">
            <h1 class="m-0">Image dan Video</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        {{-- layout kiri --}}
        <div class="col-12 col-md-6">
          {{-- logo --}}
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Logo</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <a href="/image/logo/create" class="btn btn-primary"><i class="nav-icon fas fa-plus"></i></a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Image</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($logos as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">
                        <img src="/storage/{{ $item->image }}" alt="{{ $item->image }}" width="100">
                      </td>
                      <td class="align-middle">
                        @if (Auth::user()->role == 'super_admin')
                          <a href="/image/logo/{{ $item->id }}/edit" class="btn btn-warning my-1">
                            <i class="nav-icon fas fa-pencil"></i>
                          </a>
                          <form action="/image/{{ $item->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                              onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                              <i class="nav-icon fas fa-trash"></i>
                            </button>
                          </form>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

          {{-- banner --}}
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Banner</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <a href="/image/banner/create" class="btn btn-primary"><i class="nav-icon fas fa-plus"></i></a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Image</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($banners as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">
                        <img src="/storage/{{ $item->image }}" alt="{{ $item->image }}" width="100">
                      </td>
                      <td class="align-middle">
                        @if (Auth::user()->role == 'super_admin')
                          <a href="/image/banner/{{ $item->id }}/edit" class="btn btn-warning my-1">
                            <i class="nav-icon fas fa-pencil"></i>
                          </a>
                          <form action="/image/{{ $item->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                              onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                              <i class="nav-icon fas fa-trash"></i>
                            </button>
                          </form>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          
          {{-- video --}}
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Video</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <a href="/video/create" class="btn btn-primary"><i class="nav-icon fas fa-plus"></i></a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Url</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($videos as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">
                        <a href="{{ $item->url }}" target="black" class="btn btn-primary"><i class="fas fa-link"></i></a>
                      </td>
                      <td class="align-middle">
                        @if (Auth::user()->role == 'super_admin')
                          <a href="/video/{{ $item->id }}/edit" class="btn btn-warning my-1">
                            <i class="nav-icon fas fa-pencil"></i>
                          </a>
                          <form action="/video/{{ $item->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                              onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                              <i class="nav-icon fas fa-trash"></i>
                            </button>
                          </form>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

        </div>

        {{-- layout kanan --}}
        <div class="col-12 col-md-6">
          {{-- q&a --}}
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Q&A</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <a href="/image/q&a/create" class="btn btn-primary"><i class="nav-icon fas fa-plus"></i></a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Image</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($questAnswars as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">
                        <img src="/storage/{{ $item->image }}" alt="{{ $item->image }}" width="100">
                      </td>
                      <td class="align-middle">
                        @if (Auth::user()->role == 'super_admin')
                          <a href="/image/q&a/{{ $item->id }}/edit" class="btn btn-warning my-1">
                            <i class="nav-icon fas fa-pencil"></i>
                          </a>
                          <form action="/image/{{ $item->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                              onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                              <i class="nav-icon fas fa-trash"></i>
                            </button>
                          </form>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

          {{-- thumbnail --}}
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Thumbnail</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <a href="/image/thumbnail/create" class="btn btn-primary"><i class="nav-icon fas fa-plus"></i></a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Image</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($thumbnails as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">
                        <img src="/storage/{{ $item->image }}" alt="{{ $item->image }}" width="100">
                      </td>
                      <td class="align-middle">
                        @if (Auth::user()->role == 'super_admin')
                          <a href="/image/thumbnail/{{ $item->id }}/edit" class="btn btn-warning my-1">
                            <i class="nav-icon fas fa-pencil"></i>
                          </a>
                          <form action="/image/{{ $item->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                              onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                              <i class="nav-icon fas fa-trash"></i>
                            </button>
                          </form>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>

      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
