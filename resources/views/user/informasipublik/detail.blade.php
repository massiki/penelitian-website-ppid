@extends('layouts.app')

@section('content')
  <div class="container" style="overflow-x:auto;">
    <div class="row pt-5">
      <div class="col-12 text-center">
        <div class="section-title">
          <h2>Detail Informasi {{ $information->informasi->nama ?? '' }}</h2>
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-12">
        <div class="p-4 border border-dark-subtle">
          <h3>Ringkasan</h3>
          <p>{{ $information->ringkasan_informasi ?? '' }}</p>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0 mb-3">
      <table class="table text-center border">
        <thead class="table-dark">
          <tr>
            <th class="align-middle border" >No.</th>
            <th class="align-middle border" >Informasi</th>
            <th class="align-middle border" >Tahun</th>
            <th class="align-middle border" >Link</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($details as $item)
            <tr>
              <td class="align-middle border">{{ $loop->iteration }}</td>
              <td class="text-start align-middle border">{{ $item->informasi }}</td>
              <td class="align-middle border">{{ $item->tahun }}</td>
              <td class="align-middle border">
                <a href="/storage/{{ $item->link }}" class="btn btn-info" target="_black">
                  <i class="nav-icon fas fa-download"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $details->links('pagination::bootstrap-5') }}
    </div>
  </div>
@endsection
