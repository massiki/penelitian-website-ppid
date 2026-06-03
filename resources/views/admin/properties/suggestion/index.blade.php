@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 d-flex justify-content-between">
            <h1 class="m-0">Data Saran & Pesan</h1>
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
              <h3 class="card-title">Data Saran & Pesan Pengguna</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-center">
                <thead>
                  <tr class="text-center">
                    <th class="align-middle">No</th>
                    <th class="align-middle">Nama Lengkap</th>
                    <th class="align-middle">Email</th>
                    <th class="align-middle">No. Telepon</th>
                    <th class="align-middle">Subjek</th>
                    <th class="align-middle">Pesan</th>
                  </tr>
                </thead>
                <tbody id="contentArea">
                  @forelse ($suggestions as $suggestion)
                    <tr>
                      <td class="align-middle">
                        {{ ($suggestions->currentPage() - 1) * $suggestions->perPage() + $loop->iteration }}</td>
                      <td class="align-middle">{{ $suggestion->full_name }}</td>
                      <td class="align-middle">{{ $suggestion->email }}</td>
                      <td class="align-middle">{{ $suggestion->phone }}</td>
                      <td class="align-middle">{{ $suggestion->subject }}</td>
                      <td class="align-middle">{{ $suggestion->message }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td class="align-middle" colspan="6">Tidak ada data saran atau pesan.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              {{ $suggestions->links() }}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
