@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 d-flex justify-content-between">
            <h1 class="m-0">Pengguna</h1>
            @if (Auth::user()->role == 'super_admin')
              <a href="/pengguna/create" class="btn btn-primary"><i class="nav-icon fas fa-plus"></i></a>
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
              <h3 class="card-title">Data Pengguna</h3>
              <div class="card-tools">
                <form>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="cari" class="form-control float-right" id="searchInput" placeholder="Cari nama" value="{{ request('cari') }}">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default" >
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 text-center">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="align-middle" >no</th>
                    <th class="align-middle">Nama</th>
                    <th class="align-middle">NIP</th>
                    <th class="align-middle">Email</th>
                    <th class="align-middle">Role</th>
                    <th class="align-middle">Action</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @foreach ($users as $user)
                  <tr>
                    <td class="text-center align-middle text-wrap">{{ $loop->iteration }}</td>
                    <td class="text-center align-middle text-wrap">{{ $user->name }}</td>
                    <td class="text-center align-middle text-wrap">{{ $user->nip }}</td>
                    <td class="text-center align-middle text-wrap">{{ $user->email }}</td>
                    <td class="text-center align-middle text-wrap">{{ $user->role }}</td>
                    @if ($user->role != 'super_admin')
                      <td>
                        <a href="/pengguna/{{ $user->id }}/password" class="btn btn-info my-1"><i class="fas fa-key"></i></a>
                        <a href="/pengguna/{{ $user->id }}/edit" class="btn btn-warning my-1"><i class="nav-icon fas fa-pencil"></i></a>
                        <form action="/pengguna/{{ $user->id }}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                            <i class="nav-icon fas fa-trash"></i></button></button>
                        </form>
                      </td>
                    @else
                      <td></td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          {{ $users->links('pagination::bootstrap-5') }}
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
