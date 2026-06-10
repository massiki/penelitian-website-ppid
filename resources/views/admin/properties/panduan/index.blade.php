@extends('layouts.admin')

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12 d-flex justify-content-between">
            <h1 class="m-0">Panduan</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Panduan</h3>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="align-middle">No</th>
                    <th class="align-middle">Judul</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($panduan as $item)
                    <tr>
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $item->judul }}</td>
                      <td class="align-middle">
                        @if ($item->is_active)
                          <span class="badge badge-success">Aktif</span>
                        @else
                          <span class="badge badge-danger">Nonaktif</span>
                        @endif
                      </td>
                      <td class="align-middle">
                        <a href="/panduan/{{ $item->id }}/edit" class="btn btn-warning">
                          <i class="nav-icon fas fa-pencil"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
