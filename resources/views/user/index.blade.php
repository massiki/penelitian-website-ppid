@extends('layouts.app')

@section('content')
  @include('components.hero')

  <section class="our-service-wrapper section-padding">
    <div class="container">
      <div class="col-12 col-xl-6 offset-xl-3 text-center">
				<div class="section-title">
					<span>{{ config('app.name') }}</span>
					<h2>Informasi Publik</h2>
				</div>
			</div>
      <div class="row ps-xl-5 pe-xl-5">
        @foreach ($cards as $item )
          <div class="col-xl-3 col-md-6 col-12">
            <div class="single-service-box">
              <div class="icon">
                <img src="/storage/{{ $item->icon }}" alt="{{ $item->judul }}" height="100">
              </div>
              <h4><a href="{{ $item->url }}">{{ $item->judul }}</a></h4>
              <p>{{ $item->deskripsi }}</p>
              <a href="{{ $item->url }}" class="read-more-link">Selengkapnya</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="about-wrapper section-padding pt-0">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-12">
          <div class="about-images-video-popup mb-5 mb-md-0">
            @foreach ($thumbnail as $index => $item)
              <img src="/storage/{{ $item->image }}" alt="{{ $item->image }}" width="{{ $index == 0 ? '600' : '380' }}">
            @endforeach
            <div class="video-play-btn">
              <a href="{{ $video->url }}" class="popup-video play-video"><i
                  class="fas fa-play"></i></a>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-12 ps-xl-5">
          <div class="section-title">
            <span>{{ config('app.name') }}</span>
            <h2>Layanan Informasi yang Mudah dan Transparan</h2>
            <p>RSUD Kesehatan Kerja Provinsi Jawa Barat berkomitmen untuk memberikan layanan yang inovatif dan mudah
              diakses bagi masyarakat. Kami mendukung kebutuhan informasi publik dengan solusi teknologi modern untuk
              meningkatkan transparansi dan kualitas layanan.</p>
          </div>
          <div class="row">
            @foreach ($infoServices as $item)
              <div class="col-md-6 col-sm-6">
                <div class="info-icon-item">
                  <img src="/storage/{{ $item->icon }}" alt="{{ $item->judul }}" height="100">
                  <h3>{{ $item->judul }}</h3>
                  <p>{{ $item->deskripsi }}</p>
                  <a href="{{ $item->url }}" class="theme-btn mt-30">{{ $item->nama_button }}</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="faq-wrapper left-bg-overlay section-padding bg-gradient">
    <div class="shape-top"><img src="assets/img/top-shape.png" alt=""></div>
    <div class="shape-bottom"><img src="assets/img/left-bottom-shape.png" alt=""></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-12 mb-5 mb-xl-0">
          <div class="faq-img">
            <img src="/storage/{{ $questAnswers->image }}" alt="q&a">
          </div>
        </div>
        <div class="col-xl-6 col-12 ps-xl-5">
          <div class="section-title">
            <span>{{ config('app.name') }}</span>
            <h2>Pertanyaan yang sering ditanyakan</h2>
          </div>
          <div class="faq-accordion">
            <div class="accordion" id="accordion">
              @foreach ($quest as $key => $item)
                <div class="accordion-item">
                  <h4 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#faq{{ $key }}" aria-controls="faq{{ $key }}">
                      {{ $item->judul }}
                    </button>
                  </h4>
                  <div id="faq{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordion">
                    <div class="accordion-body">
                      {{ $item->deskripsi }}
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonial-carousel-wrapper section-padding">
    <div class="container">
      <div class="col-12 col-xl-8 offset-xl-2 text-center">
        <div class="section-title">
          <span>{{ config('app.name') }}</span>
          <h2>Rating</h2>
        </div>
      </div>

      <div class="testimonial-carousel-grid-active">
        @foreach ($ratings as $item)
          <div class="single-testimonial-card">
            <div class="client-img bg-cover" style="background-image: url('assets/img/pp_rating.webp')"></div>
            <div class="content">
              <p>{{ $item->comment }}</p>
              <div class="client-rating mt-15">
                @for ($i = 0; $i < $item->star; $i++)
                  <i class="fas fa-star"></i>
                @endfor
              </div>
              <h4>{{ $item->pemohon->nama }}</h4> {{-- Nama --}}
              <span>{{ $item->pemohon->pekerjaan }}</span> {{-- pekerjaan --}}
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>

  <section class="our-news-section section-padding">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <div class="section-title">
            <span>{{ config('app.name') }}</span>
            <h2>Berita</h2>
          </div>
        </div>
      </div>

      <div class="row">
        @foreach ($news as $item)
          <div class="col-xl-4 col-md-6">
            <div class="single-blog-item">
              <a href="{{ $item->url }}">
                <div class="post-featured-thumb bg-cover" style="background-image: url('/storage/{{ $item->image }}')"></div>
              </a>
              <div class="content">
                <h3><a href="{{ $item->url }}">{{ $item->judul }}</a></h3>
                <p>{{ $item->deskripsi }}</p>
                <div class="post-meta d-flex align-items-center">
                  <div class="post-date">
                    <i class="fal fa-calendar-alt"></i>
                    {{ $item->created_at->locale('id')->translatedFormat('H:i, l, d F Y') }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  
@endsection
