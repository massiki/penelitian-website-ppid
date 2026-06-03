<div class="top-bar-wrapper d-none d-sm-block">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="top-left">
      @foreach (App\Models\Contact::take(3)->get() as $item)
        <span class="text-black" style="margin-right: 35px">{!! $item->icon !!}  {{ $item->address }}</span>
      @endforeach
    </div>
    <div class="top-right d-none d-md-block">
      <div class="social-pages">
        @foreach (App\Models\Sosmed::all() as $item)
          <a href="{{ $item->link }}" target="_blank">{!! $item->icon !!}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>
