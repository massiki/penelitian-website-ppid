@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 d-flex justify-content-between">
            <h1 class="m-0">Sub Menu</h1>
            <a href="/menu/submenu/{{ $menu->id }}/create" class="btn btn-primary"><i class="nav-icon fas fa-plus"></i></a>
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
              <h3 class="card-title">Data Submenu</h3>
              <div class="card-tools">
                <form >
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
                <div class="card-tools">
                  <p class="p-3 mb-0"><strong>Menu: </strong>{{ $menu->nama ?? '' }}</p>
                </div>
                <thead>
                  <tr>
                    <th class="align-middle">no</th>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle">URL</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($submenus as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $item->nama }}</td>
                      <td class="align-middle">
                        <a href="{{ $item->url }}" target="black" class="btn btn-primary"><i class="fas fa-link"></i></a>
                      </td>
                      <td class="align-middle">
                        <div>
                          @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                            <a href="/menu/submenu/{{ $item->id }}/edit"
                              class="btn btn-warning my-1"><i class="nav-icon fas fa-pencil"></i>
                            </a>
                            <form action="/menu/submenu/{{ $item->id }}" method="post">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="nav-icon fas fa-trash"></i>
                              </button>
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
          
          {{-- {{ $information->links('pagination::bootstrap-5') }} --}}
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  
@endsection
