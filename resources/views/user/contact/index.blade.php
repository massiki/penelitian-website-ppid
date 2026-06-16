@extends('layouts.app')

@section('content')
  <div class="page-banner-wrap text-center bg-cover" style="background-image: url({{ asset('assets/img/banner.jpg') }})">
    <div class="container">
      <div class="page-heading text-white">
        <h1>Contact Us</h1>
      </div>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">contact Us</li>
        </ol>
      </nav>
    </div>
  </div>

  <section class="contact-page-wrap section-padding">
    <div class="container">
      <div class="row pt-5">
        <div class="col-12 col-xl-8 offset-xl-2 text-center">
          <div class="section-title wow fadeInUp">
            <span>{{ config('app.name') }}</span>
            <h2>Contact Us</h2>
          </div>
        </div>

        <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
          <div class="contact-form">
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <form action="{{ route('contact.submit') }}" method="POST" class="row" id="contact-form">
              @csrf
              <div class="col-md-6 col-12">
                <div class="single-personal-info">
                  <label for="full_name">Full Name</label>
                  <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                    placeholder="Enter Name" maxlength="255">
                  @error('full_name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="single-personal-info">
                  <label for="email">Email Address</label>
                  <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Enter Email Address" maxlength="255">
                  @error('email')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="single-personal-info">
                  <label for="phone">Phone Number</label>
                  <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                    placeholder="Enter Number" maxlength="255">
                  @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="single-personal-info">
                  <label for="subject">Subject</label>
                  <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                    placeholder="Enter Subject" maxlength="255">
                  @error('subject')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-md-12 col-12">
                <div class="single-personal-info">
                  <label for="message">Enter Message</label>
                  <textarea id="message" name="message" placeholder="Enter message">{{ old('message') }}</textarea>
                  @error('message')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>
              <div class="col-md-12 col-12 text-center">
                <button class="submit-btn mb-5 mt-4 animated pulse infinite" type="submit">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
