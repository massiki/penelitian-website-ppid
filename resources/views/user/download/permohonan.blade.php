@extends('layouts.app')

@section('content')
  @if ($information->file_acc_permohonan)
    <div class="section-title text-center pt-5">
      <h2>Download Permohonan</h2>
    </div>
    <div class="col-12 col-lg-6 offset-lg-3 mb-5">
      <div class="main-sidebar">
          <iframe src="/storage/{{ $information->file_acc_permohonan }}#toolbar=0" id="fileFrame" frameborder="0" style="pointer-events: none" class="w-100" height="500"></iframe>
        <div class="d-flex gap-3 mt-5">
          @if ($rating)
            <button class="btn btn-primary w-100" onclick="downloadFile()">Unduh</button>
          @else
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#rating">
              Unduh
            </button>
          @endif
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="rating" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="ModalLabel">Berikan ulasan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/rating" method="post">
            @csrf
            <div class="modal-body text-center">
              <div class="rating">
                <span class="star" style="font-size: 36px; cursor: pointer;" onclick="setRating(1)">&#9733;</span>
                <span class="star" style="font-size: 36px; cursor: pointer;" onclick="setRating(2)">&#9733;</span>
                <span class="star" style="font-size: 36px; cursor: pointer;" onclick="setRating(3)">&#9733;</span>
                <span class="star" style="font-size: 36px; cursor: pointer;" onclick="setRating(4)">&#9733;</span>
                <span class="star" style="font-size: 36px; cursor: pointer;" onclick="setRating(5)">&#9733;</span>
              </div>
              <input type="hidden" id="ratingValue" value="{{ old('star') }}" name="star" name="star">
              @error('star')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <textarea id="reviewText" rows="4" class="form-control mt-3" placeholder="Tulis ulasan Anda di sini..."
                name="comment">{{ old('comment') }}</textarea>
              @error('comment')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <input type="hidden" name="id" value="{{ $information->id }}">
            </div>
            <div class="modal-footer">
              <button type="sumbit" class="btn btn-primary">Posting</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @else
    <div class="section-title text-center pt-5">
      <img src="{{ asset('assets/img/404.png') }}" alt="not found">
    </div>
  @endif


@endsection
