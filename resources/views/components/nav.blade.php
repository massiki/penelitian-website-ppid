<header class="header-1">
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <div class="col-lg-3 col-sm-5 col-md-4 col-6 pr-lg-5">
        <div class="logo">
          <a href="#">
            <img src="{{ '/storage/' . App\Models\BackgroundImage::where('slug', 'logo')->latest()->first()->image }}" alt="Logo" height="50">
          </a>
        </div>
      </div>
      <div class="col-lg-9 text-end p-lg-0 d-none d-lg-flex justify-content-between align-items-center">
        <div class="menu-wrap">
          <div class="main-menu">
            <ul>
              @foreach (App\Models\Menu::all() as $menu)
                <li><a href="{{$menu->url}}">{{$menu->nama}}@if ( $menu->child->count() > 0 ) <i class="fas fa-angle-down"></i></a>@endif</a>
                  @if ( $menu->child->count() > 0 )
                    <ul class="sub-menu">
                      @foreach ( $menu->child as $submenu )
                        <li><a href="{{ $submenu->url }}">{{ $submenu->nama }}</a></li>
                      @endforeach
                    </ul>
                  @endif
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="header-right-element">
          <a href="/login" class="login-btn">Log In</a>
        </div>
      </div>
      <div class="d-block d-lg-none col-sm-1 col-md-8 col-6">
        <div class="mobile-nav-wrap">
          <div id="hamburger"><i class="fal fa-bars"></i></div>
          <!-- mobile menu - responsive menu  -->
          <div class="mobile-nav">
            <button type="button" class="close-nav">
              <i class="fal fa-times-circle"></i>
            </button>
            <nav class="sidebar-nav">
              <ul class="metismenu" id="mobile-menu">
                @foreach (App\Models\Menu::all() as $menu)
                  <li><a @if ( $menu->child->count() > 0 )  class="has-arrow" @endif href="{{$menu->url}}">{{$menu->nama}}</a>
                    @if ( $menu->child->count() > 0 )
                      <ul class="sub-menu">
                        @foreach ( $menu->child as $submenu )
                          <li><a href="{{ $submenu->url }}">{{ $submenu->nama }}</a></li>
                        @endforeach
                      </ul>
                    @endif
                  </li>
                @endforeach
              </ul>
            </nav>
          
            <div class="action-bar text-white">
              <a href="/login" class="theme-btn mt-4">login</a>
            </div>
          </div>
        </div>
        <div class="overlay"></div>
      </div>
    </div>
  </div>
</header>