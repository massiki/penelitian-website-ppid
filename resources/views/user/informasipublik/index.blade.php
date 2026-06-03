@extends('layouts.app')

@section('content')
  <div class="container" style="overflow-x:auto;">
    <div class="row pt-5">
      <div class="col-12 text-center">
        <div class="section-title">
          <h2>Informasi {{ $informations->first()->informasi->nama  ?? '' }}</h2>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0 mb-3">
      <table class="table text-center border">
        <thead class="table-dark">
          <tr>
            <th class="align-middle border" rowspan="2">No.</th>
            <th class="align-middle border" rowspan="2">Ringkasan isi Informasi</th>
            <th class="align-middle border" rowspan="2">Pejabat</th>
            <th class="align-middle border" rowspan="2">Penanggungjawab</th>
            <th class="align-middle border" colspan="2">Bentuk Informasi</th>
            <th class="align-middle border" rowspan="2">Jangka Waktu Penyimpanan</th>
            <th class="align-middle border" rowspan="2">Link</th>
          </tr>
          <tr>
            <th class="align-middle border">Cetak</th>
            <th class="align-middle border">Digital</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($informations as $item)
            <tr>
              <td class="align-middle border">{{ $loop->iteration }}</td>
              <td class="text-start align-middle border">{{ $item->ringkasan_informasi }}</td>
              <td class="align-middle border">{{ $item->pejabat_penguasa_informasi }}</td>
              <td class="align-middle border">{{ $item->penanggung_jawab_informasi }}</td>
              <td class="align-middle border">
                @if ($item->bentuk_informasi_cetak == 1)
                  <i class="nav-icon fas fa-check"></i>
                @endif
              </td>
              <td class="align-middle border">
                @if ($item->bentuk_informasi_digital == 1)
                  <i class="nav-icon fas fa-check"></i>
                @endif
              </td>
              <td class="align-middle border">{{ $item->penyimpanan->nama }}</td>
              <td class="align-middle border">
                <a href="/informasi-publik/{{ $slug }}/{{ $item->id }}/details" class="btn btn-info">
                  <i class="nav-icon fas fa-download"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $informations->links('pagination::bootstrap-5') }}
    </div>
  </div>
@endsection
