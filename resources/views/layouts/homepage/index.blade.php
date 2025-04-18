<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>UpConstruction</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  {{-- <link href="{{ asset('storage/img/favicon.png') }}" rel="icon"> --}}
  <link href=" {{ asset('storage/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <!-- Main CSS File -->
  {{-- <link href="resources/homepage/assets/css/main.css" rel="stylesheet">   --}}
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" rel="stylesheet">

  @vite(['resources/js/app.js', 'resources/sass/app.scss'])
{{-- <link rel="stylesheet" href="{{ mix('resources/sass/app.scss') }}">
<script type="module" src="{{ mix('resources/js/app.js') }}"></script> --}}

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center text-decoration-none">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">UpConstruction</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('homepage.index') }}" class="text-decoration-none {{ request()->routeIs('homepage.index') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ route('homepage.about') }}" class="text-decoration-none {{ request()->routeIs('homepage.about') ? 'active' : '' }}">About</a></li>
          <li><a href="{{ route('homepage.services') }}" class="text-decoration-none {{ request()->routeIs('homepage.services') ? 'active' : '' }}">Services</a></li>
          <li><a href="{{ route('homepage.projects') }}" class="text-decoration-none {{ request()->routeIs('homepage.projects') ? 'active' : '' }}">Projects</a></li>
          <li><a href="{{ route('homepage.blog') }}" class="text-decoration-none {{ request()->routeIs('homepage.blog') ? 'active' : '' }}">Blog</a></li>
          <li><a href="{{ route('homepage.contact') }}" class="text-decoration-none {{ request()->routeIs('homepage.contact') ? 'active' : '' }}">Contact</a></li>
          @auth
          <li><a href="{{ route('admin.index') }}" class="text-decoration-none {{ request()->routeIs('admin.index') ? 'active' : '' }}">Admin</a></li>
          @else
          <li><a href="{{ route('login') }}" class="text-decoration-none {{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
          <li><a href="{{ route('register') }}" class="text-decoration-none {{ request()->routeIs('register') ? 'active' : '' }}">Register</a></li>
          @endauth
        </ul>
        
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">
    @yield('content')
  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center text-decoration-none">
            <span class="sitename">UpConstruction</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Beach drive</p>
            <p>Nungua, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+233 533 247 599</span></p>
            <p><strong>Email:</strong> <span>aclement724@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="{{route('homepage.index')}}" class="text-decoration-none">Home</a></li>
            <li><a href="{{route('homepage.about')}}" class="text-decoration-none">About us</a></li>
            <li><a href="{{route('homepage.services')}}" class="text-decoration-none">Services</a></li>
            <li><a href="{{route('homepage.contact')}}" class="text-decoration-none">Contact</a></li>
            <li><a href="{{route('homepage.projects')}}" class="text-decoration-none">Projects</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        {{-- <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div> --}}

        {{-- <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div> --}}

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">UpConstruction</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
 

  <!-- Main JS File -->
  {{-- <script src="resources/homepage/assets/js/main.js"></script> --}}

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <script>
    AOS.init();
    const lightbox = GLightbox();
  </script>
</body>

</html>