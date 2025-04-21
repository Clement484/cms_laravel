@extends('layouts.homepage.index')

@section('content')

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ Vite::asset('resources/homepage/assets/img/page-title-bg.jpg')}});">
      <div class="container position-relative">
        <h1>Contact</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{route('homepage.index')}}" class="text-decoration-none text-warning">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <p>Beach drive, Nungua, NY 535022</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Call Us</h3>
              <p>+233 533 247 599</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Email Us</h3>
              <p>aclement724@gmail.com</p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="row gy-4 mt-1">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.842673183801!2d-0.08056762527157833!3d5.590255333304802!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf85d90c91f441%3A0x41ecece72670d85c!2sWinners%20Chapel%20Int&#39;l%20Teshie-Nungua!5e0!3m2!1sen!2sgh!4v1744824965120!5m2!1sen!2sgh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div><!-- End Google Maps -->

          <div class="col-lg-6">
            <form action="{{route('messages.store')}}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
              @csrf
              
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Your Name" required="">
                  @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Your Email" required="">
                  @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" value="{{old('subject')}}" placeholder="Subject" required="">
                  @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="content" rows="6" placeholder="Message" required="">{{old('content')}}</textarea>
                  @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

          @if(session('success'))
          <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
              <div class="toast align-items-center text-white bg-success border-0 show" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="d-flex">
                      <div class="toast-body">
                          {{ session('success') }}
                      </div>
                      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
              </div>
          </div>
          @endif
        </div>

      </div>

    </section><!-- /Contact Section -->


@endsection
