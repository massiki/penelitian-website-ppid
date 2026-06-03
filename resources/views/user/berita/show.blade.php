@extends('layouts.app')

@section('content')
  <section class="blog-wrapper news-wrapper section-padding">
    <div class="container">
      <div class="row">
        {{-- layout kiri --}}
        <div class="col-12 col-lg-8">
          <div class="blog-post-details border-wrap">
            <div class="single-blog-post post-details">
              <div class="post-content">
                <h1><strong>{{ $item->judul }}</strong></h1>
                <div class="post-meta">
                  <span>
                    <i class="fal fa-calendar-alt"></i>{{ $item->created_at->locale('id')->translatedFormat('H:i, l, d F Y') }}
                  </span>
                </div>
                <img class="w-100" src="/storage/{{ $item->image }}" alt="{{ $item->image }}">
                <p>{!! $item->deskripsi_detail !!}</p>
              </div>
            </div>
          </div>
        </div>
        {{-- layout kanan --}}
        <div class="col-12 col-lg-4">
          <div class="main-sidebar">
            <div class="single-sidebar-widget">
              <div class="wid-title">
                <h3>Cari</h3>
              </div>
              <div class="search_widget">
                <form action="/berita" method="get">
                  <input type="text" name="search" placeholder="Cari Berita..." value="{{ request('search') }}">
                  <button type="submit"><i class="fal fa-search"></i></button>
                </form>
              </div>
            </div>
            <div class="single-sidebar-widget">
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
            <div class="single-sidebar-widget">
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
