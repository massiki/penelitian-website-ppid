<footer class="footer-1 footer-wrap">
  <div class="footer-widgets-wrapper text-white bg-cover"
    style="background-image: url('/assets/img/footer-widgets-bg.png'); padding: 70px 0">
    <div class="container">
      <div class="row justify-content-between">

        <div class="col-sm-6 col-xl-3">
          <div class="single-footer-wid ps-xl-5">
            <div class="wid-title">
              <h3>Informasi</h3>
            </div>
            <ul>
              @foreach (App\Models\Informasi::get() as $item)
                <li><a href="{{ $item->url }}">{{ $item->nama }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="col-sm-6 col-xl-3">
          <div class="single-footer-wid ps-xl-2">
            <div class="wid-title">
              <h3>Media Sosial</h3>
            </div>
            <ul>
              @foreach (App\Models\Sosmed::all() as $item)
                <li><a href="{{ $item->link }}" target="_black">{{ $item->nama }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>

        <div class="col-sm-6 col-xl-3">
          <div class="single-footer-wid site-info-widget">
            <div class="wid-title">
              <h3>Kontak Kami</h3>
            </div>
            <div class="get-in-touch">
              @foreach (App\Models\Contact::all() as $item)
                <div class="single-contact-info">
                  <div class="icon id1">
                    {!! $item->icon !!}
                  </div>
                  <div class="contact-info">
                    <span>{{ $item->address }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-xl-3">
          <div class="single-footer-wid site-info-widget">
            <div class="wid-title">
              <h3>Lokasi</h3>
            </div>
            <div>
              <iframe src="{{ App\Models\Lokasi::latest()->first()->lokasi }}" class="w-100" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container align-items-center">
      <div class="bottom-content-wrapper">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="copy-rights">
              <p>Copyright &copy; {{ date('Y') }} <strong>RSUD</strong> Kesehatan Kerja</p>
            </div>
          </div>
          <div class="col-md-6 mt-2 mt-md-0 col-12 text-md-end">
            <div class="social-links">
              @foreach (App\Models\Sosmed::all() as $item)
                <a href="{{ $item->link }}" target="_blank">{!! $item->icon !!}</a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
