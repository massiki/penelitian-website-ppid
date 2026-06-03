@extends('layouts.app')

@section('content')
  @if ($information->file_acc_pengajuan)
    <div class="section-title text-center pt-5">
      <h2>Download pengajuan</h2>
    </div>
    <div class="col-12 col-lg-6 offset-lg-3 mb-5">
      <div class="main-sidebar">
          <iframe src="/storage/{{ $information->file_acc_pengajuan }}#toolbar=0" id="fileFrame" frameborder="0" style="pointer-events: none" class="w-100" height="500"></iframe>
        <div class="d-flex gap-3 mt-5">
          <button class="btn btn-primary w-100" onclick="downloadFile()">Unduh</button>
        </div>
      </div>
    </div>
  @else
    <div class="section-title text-center pt-5">
      <img src="{{ asset('assets/img/404.png') }}" alt="not found">
    </div>
  @endif


@endsection
