@extends('layouts.app')

@section('content')
  <section class="blog-wrapper news-wrapper section-padding">
    <div class="container">
      <div class="row">
        {{-- layout kiri --}}
        <div class="col-12 col-lg-8">
          <div class="blog-posts">
            @if ($berita->isEmpty())
              <div class="text-center wow fadeInUp">
                <img src="/assets/img/404.png" alt="not found">
                <p><strong>Berita tidak ditemukan</strong></p>
              </div>
            @else
              @foreach ($berita as $index => $item)
                <div class="single-blog-post wow fadeInUp" data-wow-delay="{{ 0.1 + $index * 0.1 }}s">
                  <a href="{{ $item->url }}">
                    <div class="post-featured-thumb bg-cover"
                      style="background-image: url('/storage/{{ $item->image }}')"></div>
                  </a>
                  <div class="post-content">
                    <h2><a href="{{ $item->url }}">{{ $item->judul }}</a></h2>
                    <div class="post-meta">
                      <span><i
                          class="fal fa-calendar-alt"></i>{{ $item->created_at->locale('id')->translatedFormat('H:i, l, d F Y') }}</span>
                    </div>
                    <p>{{ $item->deskripsi }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-30">
                      <div class="post-link">
                        <a href="{{ $item->url }}"><i class="fal fa-arrow-right"></i> Baca Selengkapnya</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
            {{ $berita->links('pagination::bootstrap-5') }}
          </div>
        </div>
        {{-- layout kanan --}}
        <div class="col-12 col-lg-4">
          <div class="main-sidebar">
            <div class="single-sidebar-widget wow fadeInUp" data-wow-delay="0.1s">
              <div class="wid-title">
                <h3>Cari</h3>
              </div>
              <div class="search_widget">
                <form action="">
                  <input type="text" name="search" placeholder="Cari Berita..." value="{{ request('search') }}">
                  <button type="submit" aria-label="Cari berita"><i class="fal fa-search"></i></button>
                </form>
              </div>
            </div>
            <div class="single-sidebar-widget wow fadeInUp" data-wow-delay="0.2s">
              <div class="wid-title">
                <h3>Berita Populer</h3>
              </div>
              <div class="popular-posts">
                @foreach ($beritaPopular as $item)
                  <div class="single-post-item">
                    <div class="thumb bg-cover" style="background-image: url('/storage/{{ $item->image }}')"></div>
                    <div class="post-content">
                      <h5><a href="{{ $item->url }}">{{ $item->judul }}</a></h5>
                      <div>
                        dibaca {{ $item->views }} kali
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="single-sidebar-widget wow fadeInUp" data-wow-delay="0.3s">
              <div class="wid-title">
                <h3>Sosial Media</h3>
              </div>
              <div class="social-link">
                @foreach ($sosmed as $item)
                  <a href="{{ $item->link }}" target="blank">{!! $item->icon !!}</a>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
