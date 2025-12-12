<!DOCTYPE html>
<html lang="id" class="light-style layout-navbar-fixed layout-wide " dir="ltr" data-theme="theme-default" data-assets-path="/assets/" data-template="front-pages">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>QuadraLearn</title>


    <meta name="description" content="Media Pembelajaran Interaktif Berbasis Web pada Materi Fungsi Kuadrat Kelas X dengan Metode Tutorial" />
    <meta name="keywords" content="quadralearn, fungsi kuadrat, media pembelajaran interaktif, 404 Not Found Indonesia">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('404_Black.jpg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" class="template-customizer-core-css" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" class="template-customizer-theme-css" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page.css') }}" />
    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />

    <!-- Custom Responsive CSS -->
    <style>
        /* Container and spacing improvements */
        .container {
            padding-left: 20px;
            padding-right: 20px;
        }
        
        @media (min-width: 576px) {
            .container {
                padding-left: 30px;
                padding-right: 30px;
            }
        }
        
        @media (min-width: 768px) {
            .container {
                padding-left: 40px;
                padding-right: 40px;
            }
        }
        
        @media (min-width: 992px) {
            .container {
                padding-left: 60px;
                padding-right: 60px;
            }
        }
        
        @media (min-width: 1200px) {
            .container {
                padding-left: 80px;
                padding-right: 80px;
            }
        }

        /* Section spacing */
        .section-py {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }
        
        @media (max-width: 767px) {
            .section-py {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }
        }

        /* Card spacing and shadows */
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(161, 172, 184, 0.15);
            border: 1px solid rgba(161, 172, 184, 0.15);
            margin-bottom: 1.5rem;
        }

        .features-icon-box {
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 767px) {
            .features-icon-box {
                padding: 1rem;
                margin-bottom: 1.5rem;
            }
        }

        /* Hero section improvements */
        .hero-text-box {
            padding: 2rem 1rem;
            margin-bottom: 3rem;
        }

        @media (min-width: 768px) {
            .hero-text-box {
                padding: 3rem 2rem;
                margin-bottom: 4rem;
            }
        }

        /* Statistics section */
        .statistics-item {
            text-align: center;
            padding: 2rem 1rem;
        }

        .statistics-item .badge {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
        }

        /* About section image */
        .about-image-container {
            position: relative;
            margin-bottom: 2rem;
        }

        @media (min-width: 992px) {
            .about-image-container {
                margin-bottom: 0;
            }
        }

        /* Features section */
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .feature-icon i {
            font-size: 1.75rem;
        }

        /* Curriculum cards */
        .curriculum-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .curriculum-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(161, 172, 184, 0.25);
        }

        /* Learning path section */
        .learning-path-step {
            text-align: center;
            margin-bottom: 1rem;
        }

        .learning-path-step .badge {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
        }

        /* Testimonials */
        .testimonial-card {
            height: 100%;
            transition: box-shadow 0.3s ease;
        }

        .testimonial-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(161, 172, 184, 0.25);
        }

        .avatar {
            width: 50px;
            height: 50px;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* FAQ section */
        .accordion-button {
            padding: 1.25rem 1.5rem;
            font-weight: 500;
        }

        .accordion-body {
            padding: 1.5rem;
            line-height: 1.6;
        }

        /* Team section */
        .team-card {
            transition: transform 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
        }

        /* Contact form */
        .contact-form .form-control {
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        .contact-img-box {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        /* Footer improvements */
        .footer-top {
            padding: 4rem 0 2rem;
        }

        .footer-title {
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: inherit;
        }

        .footer-link {
            color: rgba(161, 172, 184, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
            line-height: 1.6;
        }

        .footer-link:hover {
            color: #696cff;
        }

        /* Button improvements */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            box-shadow: 0 0.125rem 0.25rem rgba(105, 108, 255, 0.4);
        }

        .btn-primary:hover {
            box-shadow: 0 0.25rem 0.5rem rgba(105, 108, 255, 0.6);
            transform: translateY(-1px);
        }

        /* Responsive text sizes */
        @media (max-width: 767px) {
            .display-4 {
                font-size: 2rem;
            }
            
            .h2 {
                font-size: 1.5rem;
            }
            
            h3 {
                font-size: 1.25rem;
            }
            
            h5 {
                font-size: 1rem;
            }
        }

        /* Spacing utilities */
        .py-section {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        @media (max-width: 767px) {
            .py-section {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }
        }

        .mb-section {
            margin-bottom: 3rem;
        }

        @media (max-width: 767px) {
            .mb-section {
                margin-bottom: 2rem;
            }
        }

        /* Navigation improvements */
        .navbar {
            padding: 1rem 0;
        }

        .nav-link {
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        /* Mobile menu improvements */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: #fff;
                border-radius: 0.5rem;
                box-shadow: 0 0.5rem 1rem rgba(161, 172, 184, 0.25);
                margin-top: 1rem;
                padding: 1rem;
            }
        }

        /* Image responsiveness */
        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        /* Progress bars */
        .progress {
            border-radius: 0.25rem;
            overflow: hidden;
        }

        /* Badge improvements */
        .badge {
            font-weight: 500;
            padding: 0.5rem 1rem;
        }

        /* Animation improvements */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Loading improvements */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, transparent 37%, #f0f0f0 63%);
            background-size: 400% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/front-config.js') }}"></script>

</head>

<body>

<script src="{{ asset('assets/vendor/js/dropdown-hover.js') }}"></script>
<script src="{{ asset('assets/vendor/js/mega-dropdown.js') }}"></script>

<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
  <div class="container">
    <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4 ">
      <!-- Menu logo wrapper: Start -->
      <div class="navbar-brand app-brand demo d-flex py-0 me-4">
        <!-- Mobile menu toggle: Start-->
        <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="tf-icons bx bx-menu bx-sm align-middle"></i>
        </button>
        <!-- Mobile menu toggle: End-->
        <a href="#landingHero" class="app-brand-link">
          <span class="app-brand-logo demo"><img src="{{ asset('404_Black.jpg') }}" alt="404 Not Found Indonesia" width="30" style="border-radius: 150px" srcset=""></span>
          <span class="app-brand-text menu-text fw-bold ms-2 ps-1">QuadraLearn</span>
        </a>
      </div>
      <!-- Menu logo wrapper: End -->
      <!-- Menu wrapper: Start -->
      <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
        <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="tf-icons bx bx-x bx-sm"></i>
        </button>
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link fw-medium" aria-current="page" href="#landingHero">Utama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="#landingAbout">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="#landingFeatures">Fitur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="#landingCurriculum">Kurikulum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="#landingTestimonials">Testimoni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="#landingTeam">Tim</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="#landingContact">Daftar</a>
          </li>
        </ul>
      </div>
      <div class="landing-menu-overlay d-lg-none"></div>
      <!-- Menu wrapper: End -->
      <!-- Toolbar: Start -->
      <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- navbar button: Start -->
        <li>
            <a href="{{ route('login') }}" class="btn btn-primary">
                <span class="tf-icons bx bx-user me-md-1"></span>
                @guest
                    <span class="d-none d-md-block">Masuk</span>
                @else
                    <span class="d-none d-md-block">{{ auth()->user()->name }}</span>
                @endguest
            </a>
        </li>
        <!-- navbar button: End -->
      </ul>
      <!-- Toolbar: End -->
    </div>
  </div>
</nav>
<!-- Navbar: End -->


<!-- Sections:Start -->


<div data-bs-spy="scroll" class="scrollspy-example">
  <!-- Hero: Start -->
  <section id="hero-animation">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/backgrounds/hero-bg.png" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class="hero-text-box text-center">
          <h1 class="text-primary hero-title display-4 fw-bold">Belajar fungsi kuadrat dengan cermat</h1>
          <h2 class="hero-sub-title h6 mb-4 pb-1">
            Media Pembelajaran Interaktif Berbasis Web <br class="d-none d-lg-block" /> Pada Materi Fungsi Kuadrat Kelas X Dengan Metode Tutorial
          </h2>
          <div class="landing-hero-btn d-inline-block position-relative">
            <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Yuk gabung
              <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/Join-community-arrow.png" alt="Join community arrow" class="scaleX-n1-rtl" /></span>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Mulai belajar!</a>
          </div>
        </div>
        <div id="heroDashboardAnimation" class="hero-animation-img">
          <a href="{{ route('dashboard') }}" target="_blank">
            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
              <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/landing-page/hero-dashboard-light.png" alt="hero dashboard" class="animation-img" data-app-light-img="front-pages/landing-page/hero-dashboard-light.png" data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
              <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/landing-page/hero-elements-light.png" alt="hero elements" class="position-absolute hero-elements-img animation-img top-0 start-0" data-app-light-img="front-pages/landing-page/hero-elements-light.png" data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="landing-hero-blank"></div>
  </section>
  <!-- Hero: End -->

  <!-- About: Start -->
  <section id="landingAbout" class="section-py bg-body landing-about">
    <div class="container">
      <div class="row gy-4 align-items-center">
        <div class="col-lg-6">
          <div class="badge bg-label-primary mb-3">Tentang QuadraLearn</div>
          <h3 class="mb-3">Platform Pembelajaran Fungsi Kuadrat yang Komprehensif</h3>
          <p class="fw-medium text-heading mb-4">
            QuadraLearn adalah media pembelajaran interaktif berbasis web yang dirancang khusus untuk siswa kelas X 
            dalam mempelajari materi fungsi kuadrat dengan metode tutorial yang terintegrasi.
          </p>
          <div class="row gy-3">
            <div class="col-12">
              <div class="d-flex">
                <div class="badge bg-label-success rounded p-1 me-3">
                  <i class="bx bx-check bx-xs"></i>
                </div>
                <div>
                  <h6 class="mb-0">Metode Tutorial Terintegrasi</h6>
                  <small class="text-muted">Pembelajaran step-by-step dengan panduan yang jelas</small>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="d-flex">
                <div class="badge bg-label-success rounded p-1 me-3">
                  <i class="bx bx-check bx-xs"></i>
                </div>
                <div>
                  <h6 class="mb-0">Visualisasi Interaktif</h6>
                  <small class="text-muted">Grafik dan animasi untuk memahami konsep dengan mudah</small>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="d-flex">
                <div class="badge bg-label-success rounded p-1 me-3">
                  <i class="bx bx-check bx-xs"></i>
                </div>
                <div>
                  <h6 class="mb-0">Progress Tracking</h6>
                  <small class="text-muted">Pantau kemajuan belajar secara real-time</small>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="d-flex">
                <div class="badge bg-label-success rounded p-1 me-3">
                  <i class="bx bx-check bx-xs"></i>
                </div>
                <div>
                  <h6 class="mb-0">Evaluasi Berkelanjutan</h6>
                  <small class="text-muted">Sistem penilaian otomatis dengan feedback instant</small>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <a href="#landingFeatures" class="btn btn-primary me-2">Jelajahi Fitur</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Mulai Sekarang</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-image-container">
            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                 alt="Students learning mathematics" class="img-fluid rounded shadow-sm">
            <div class="position-absolute top-0 end-0 p-3">
              <div class="bg-primary text-white rounded p-3 shadow fade-in-up">
                <div class="d-flex align-items-center">
                  <i class="bx bx-math text-white me-2"></i>
                  <div>
                    <h6 class="text-white mb-0">f(x) = ax² + bx + c</h6>
                    <small>Fungsi Kuadrat</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- About: End -->

  <!-- Statistics: Start -->
  <section class="py-section bg-light">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-3 col-md-6">
          <div class="statistics-item fade-in-up">
            <div class="badge bg-label-primary rounded">
              <i class="bx bx-user"></i>
            </div>
            <h4 class="mb-1 fw-bold">1000+</h4>
            <p class="text-muted mb-0">Siswa Aktif</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="statistics-item fade-in-up">
            <div class="badge bg-label-success rounded">
              <i class="bx bx-book"></i>
            </div>
            <h4 class="mb-1 fw-bold">50+</h4>
            <p class="text-muted mb-0">Modul Pembelajaran</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="statistics-item fade-in-up">
            <div class="badge bg-label-warning rounded">
              <i class="bx bx-trophy"></i>
            </div>
            <h4 class="mb-1 fw-bold">95%</h4>
            <p class="text-muted mb-0">Tingkat Kelulusan</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="statistics-item fade-in-up">
            <div class="badge bg-label-info rounded">
              <i class="bx bx-time"></i>
            </div>
            <h4 class="mb-1 fw-bold">24/7</h4>
            <p class="text-muted mb-0">Akses Pembelajaran</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Statistics: End -->

  <!-- Useful features: Start -->
  <section id="landingFeatures" class="section-py landing-features">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Fitur Unggulan</span>
      </div>
      <h3 class="text-center mb-1">Fitur Pembelajaran yang Komprehensif</h3>
      <p class="text-center mb-3 mb-md-5 pb-3">
        Platform pembelajaran yang dilengkapi dengan berbagai fitur canggih untuk mendukung proses belajar mengajar yang efektif
      </p>
      <div class="row g-4 g-lg-5">
        <div class="col-lg-4 col-md-6">
          <div class="text-center features-icon-box fade-in-up">
            <div class="feature-icon bg-label-primary rounded mx-auto">
              <i class="bx bx-brain text-primary"></i>
            </div>
            <h5 class="mb-3 fw-semibold">Pembelajaran Interaktif</h5>
            <p class="features-icon-description text-muted lh-lg">
              Materi yang disajikan secara interaktif dengan visualisasi grafik dan simulasi fungsi kuadrat
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="text-center features-icon-box fade-in-up">
            <div class="feature-icon bg-label-success rounded mx-auto">
              <i class="bx bx-line-chart text-success"></i>
            </div>
            <h5 class="mb-3 fw-semibold">Progress Tracking</h5>
            <p class="features-icon-description text-muted lh-lg">
              Pantau kemajuan belajar siswa secara real-time dengan analitik yang mendalam
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="text-center features-icon-box fade-in-up">
            <div class="feature-icon bg-label-warning rounded mx-auto">
              <i class="bx bx-math text-warning"></i>
            </div>
            <h5 class="mb-3 fw-semibold">Grafik Dinamis</h5>
            <p class="features-icon-description text-muted lh-lg">
              Visualisasi grafik fungsi kuadrat yang dapat dimanipulasi untuk pemahaman yang lebih baik
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="text-center features-icon-box fade-in-up">
            <div class="feature-icon bg-label-info rounded mx-auto">
              <i class="bx bx-check-shield text-info"></i>
            </div>
            <h5 class="mb-3 fw-semibold">Evaluasi Otomatis</h5>
            <p class="features-icon-description text-muted lh-lg">
              Sistem penilaian otomatis dengan feedback langsung untuk setiap jawaban siswa
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="text-center features-icon-box fade-in-up">
            <div class="feature-icon bg-label-danger rounded mx-auto">
              <i class="bx bx-group text-danger"></i>
            </div>
            <h5 class="mb-3 fw-semibold">Manajemen Kelas</h5>
            <p class="features-icon-description text-muted lh-lg">
              Guru dapat mengelola kelas, memantau siswa, dan memberikan tugas dengan mudah
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="text-center features-icon-box fade-in-up">
            <div class="feature-icon bg-label-dark rounded mx-auto">
              <i class="bx bx-mobile text-dark"></i>
            </div>
            <h5 class="mb-3 fw-semibold">Responsive Design</h5>
            <p class="features-icon-description text-muted lh-lg">
              Akses pembelajaran dari perangkat apapun - desktop, tablet, atau smartphone
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Useful features: End -->

  <!-- Curriculum: Start -->
  <section id="landingCurriculum" class="section-py bg-body">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Kurikulum</span>
      </div>
      <h3 class="text-center mb-1">Struktur Pembelajaran Fungsi Kuadrat</h3>
      <p class="text-center mb-5 pb-3">
        Pembelajaran terstruktur dengan metode tutorial yang memastikan pemahaman konsep secara bertahap
      </p>
      
      <div class="row g-4 mb-section">
        <!-- Pendahuluan -->
        <div class="col-lg-3 col-md-6">
          <div class="card curriculum-card">
            <div class="card-header bg-label-primary">
              <div class="d-flex align-items-center">
                <div class="badge bg-primary rounded me-3 p-2">
                  <i class="bx bx-play text-white"></i>
                </div>
                <h6 class="mb-0 fw-semibold">Pendahuluan</h6>
              </div>
            </div>
            <div class="card-body">
              <p class="mb-3 text-muted">Pengenalan konsep dasar fungsi kuadrat dan karakteristiknya</p>
              <ul class="list-unstyled">
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Definisi fungsi kuadrat</span>
                </li>
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Bentuk umum</span>
                </li>
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Contoh dalam kehidupan</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Materi 1 -->
        <div class="col-lg-3 col-md-6">
          <div class="card curriculum-card">
            <div class="card-header bg-label-success">
              <div class="d-flex align-items-center">
                <div class="badge bg-success rounded me-3 p-2">
                  <i class="bx bx-book text-white"></i>
                </div>
                <h6 class="mb-0 fw-semibold">Materi 1</h6>
              </div>
            </div>
            <div class="card-body">
              <p class="mb-3 text-muted">Karakteristik dan sifat-sifat fungsi kuadrat</p>
              <ul class="list-unstyled">
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Titik puncak (vertex)</span>
                </li>
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Sumbu simetri</span>
                </li>
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Nilai optimum</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Materi 2 -->
        <div class="col-lg-3 col-md-6">
          <div class="card curriculum-card">
            <div class="card-header bg-label-info">
              <div class="d-flex align-items-center">
                <div class="badge bg-info rounded me-3 p-2">
                  <i class="bx bx-line-chart text-white"></i>
                </div>
                <h6 class="mb-0 fw-semibold">Materi 2</h6>
              </div>
            </div>
            <div class="card-body">
              <p class="mb-3 text-muted">Menggambar grafik fungsi kuadrat</p>
              <ul class="list-unstyled">
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Menentukan titik potong</span>
                </li>
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Sketsa grafik</span>
                </li>
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Transformasi grafik</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Materi 3 -->
        <div class="col-lg-3 col-md-6">
          <div class="card curriculum-card">
            <div class="card-header bg-label-warning">
              <div class="d-flex align-items-center">
                <div class="badge bg-warning rounded me-3 p-2">
                  <i class="bx bx-cog text-white"></i>
                </div>
                <h6 class="mb-0 fw-semibold">Materi 3</h6>
              </div>
            </div>
            <div class="card-body">
              <p class="mb-3 text-muted">Aplikasi dan penerapan fungsi kuadrat</p>
              <ul class="list-unstyled">
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Masalah optimisasi</span>
                </li>
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Gerak proyektil</span>
                </li>
                <li class="mb-2 d-flex align-items-center">
                  <i class="bx bx-check text-success me-2"></i>
                  <span class="small">Ekonomi dan bisnis</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Learning Path -->
      <div class="row">
        <div class="col-12">
          <div class="card bg-primary text-white shadow-lg">
            <div class="card-body text-center py-5">
              <h5 class="text-white mb-4 fw-bold">Metode Tutorial Terintegrasi</h5>
              <div class="row align-items-center justify-content-center">
                <div class="col-lg-2 col-6 col-md-3 mb-3">
                  <div class="learning-path-step">
                    <div class="badge bg-white text-primary rounded">
                      <i class="bx bx-book-reader"></i>
                    </div>
                    <p class="mt-2 mb-0 small text-white fw-medium">Latihan</p>
                  </div>
                </div>
                <div class="col-lg-1 d-none d-lg-block mb-3">
                  <i class="bx bx-chevron-right text-white-50 fs-4"></i>
                </div>
                <div class="col-lg-2 col-6 col-md-3 mb-3">
                  <div class="learning-path-step">
                    <div class="badge bg-white text-primary rounded">
                      <i class="bx bx-test-tube"></i>
                    </div>
                    <p class="mt-2 mb-0 small text-white fw-medium">Eksplorasi</p>
                  </div>
                </div>
                <div class="col-lg-1 d-none d-lg-block mb-3">
                  <i class="bx bx-chevron-right text-white-50 fs-4"></i>
                </div>
                <div class="col-lg-2 col-6 col-md-3 mb-3">
                  <div class="learning-path-step">
                    <div class="badge bg-white text-primary rounded">
                      <i class="bx bx-check-circle"></i>
                    </div>
                    <p class="mt-2 mb-0 small text-white fw-medium">Evaluasi</p>
                  </div>
                </div>
                <div class="col-lg-1 d-none d-lg-block mb-3">
                  <i class="bx bx-chevron-right text-white-50 fs-4"></i>
                </div>
                <div class="col-lg-2 col-6 col-md-3 mb-3">
                  <div class="learning-path-step">
                    <div class="badge bg-white text-primary rounded">
                      <i class="bx bx-trophy"></i>
                    </div>
                    <p class="mt-2 mb-0 small text-white fw-medium">Sertifikat</p>
                  </div>
                </div>
              </div>
              <div class="mt-4 px-3">
                <p class="text-white-50 mb-0 lh-lg">
                  Setiap modul harus diselesaikan dengan nilai minimum 75% untuk melanjutkan ke materi berikutnya
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Curriculum: End -->

  <!-- Testimonials: Start -->
  <section id="landingTestimonials" class="section-py">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Testimoni</span>
      </div>
      <h3 class="text-center mb-1">Apa kata mereka tentang QuadraLearn?</h3>
      <p class="text-center mb-5 pb-3">
        Dengarkan pengalaman siswa dan guru yang telah menggunakan platform pembelajaran kami
      </p>
      
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="card testimonial-card">
            <div class="card-body p-4">
              <div class="d-flex mb-3">
                <div class="avatar me-3">
                  <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Student" class="rounded-circle">
                </div>
                <div>
                  <h6 class="mb-0 fw-semibold">Sari Wijayanti</h6>
                  <small class="text-muted">Siswa Kelas X IPA 1</small>
                </div>
              </div>
              <div class="mb-3">
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
              </div>
              <p class="mb-0 text-muted lh-lg">
                "QuadraLearn membuat matematika jadi lebih mudah dipahami. Visualisasi grafiknya sangat membantu saya memahami konsep fungsi kuadrat yang sebelumnya sulit!"
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="card testimonial-card">
            <div class="card-body p-4">
              <div class="d-flex mb-3">
                <div class="avatar me-3">
                  <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Student" class="rounded-circle">
                </div>
                <div>
                  <h6 class="mb-0 fw-semibold">Ahmad Firdaus</h6>
                  <small class="text-muted">Siswa Kelas X IPA 2</small>
                </div>
              </div>
              <div class="mb-3">
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
              </div>
              <p class="mb-0 text-muted lh-lg">
                "Fitur latihan interaktifnya seru banget! Saya bisa belajar sambil bermain dan langsung tahu kalau jawaban saya benar atau salah. Nilai matematika saya jadi naik!"
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6 mx-auto">
          <div class="card testimonial-card">
            <div class="card-body p-4">
              <div class="d-flex mb-3">
                <div class="avatar me-3">
                  <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Teacher" class="rounded-circle">
                </div>
                <div>
                  <h6 class="mb-0 fw-semibold">Ibu Siti Nurhaliza</h6>
                  <small class="text-muted">Guru Matematika</small>
                </div>
              </div>
              <div class="mb-3">
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
                <i class="bx bxs-star text-warning"></i>
              </div>
              <p class="mb-0 text-muted lh-lg">
                "Platform ini sangat membantu dalam mengajar. Dashboard guru memudahkan saya memantau progress setiap siswa dan memberikan bantuan yang tepat sasaran."
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Testimonials: End -->

  <!-- FAQ: Start -->
  <section id="landingFAQ" class="section-py bg-body">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">FAQ</span>
      </div>
      <h3 class="text-center mb-1">Pertanyaan yang Sering Diajukan</h3>
      <p class="text-center mb-5 pb-3">
        Temukan jawaban atas pertanyaan umum seputar platform QuadraLearn
      </p>
      
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="accordion" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="accordion-item border">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                  Apa itu QuadraLearn dan siapa yang bisa menggunakannya?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  QuadraLearn adalah platform pembelajaran interaktif yang dirancang khusus untuk siswa kelas X dalam mempelajari materi fungsi kuadrat. Platform ini dapat digunakan oleh siswa, guru, dan administrator sekolah untuk mendukung proses pembelajaran matematika yang lebih efektif.
                </div>
              </div>
            </div>

            <!-- FAQ 2 -->
            <div class="accordion-item border">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                  Bagaimana cara mendaftar dan memulai pembelajaran?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Untuk mendaftar, Anda dapat mengisi formulir registrasi yang tersedia di halaman ini atau mengklik tombol "Masuk" jika sudah memiliki akun. Siswa perlu memasukkan NIS, nama lengkap, email, dan password. Setelah terdaftar, Anda dapat langsung mengakses materi pembelajaran yang tersedia.
                </div>
              </div>
            </div>

            <!-- FAQ 3 -->
            <div class="accordion-item border">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                  Apakah ada persyaratan sistem untuk menggunakan platform ini?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  QuadraLearn adalah aplikasi web yang dapat diakses melalui browser modern seperti Chrome, Firefox, Safari, atau Edge. Anda hanya memerlukan koneksi internet yang stabil. Platform ini responsif dan dapat digunakan di desktop, tablet, maupun smartphone.
                </div>
              </div>
            </div>

            <!-- FAQ 4 -->
            <div class="accordion-item border">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                  Bagaimana sistem penilaian di QuadraLearn?
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Sistem penilaian menggunakan metode tutorial terintegrasi dimana siswa harus mencapai nilai minimum 75% pada setiap modul untuk dapat melanjutkan ke materi berikutnya. Penilaian dilakukan secara otomatis dengan feedback langsung setelah menjawab setiap soal.
                </div>
              </div>
            </div>

            <!-- FAQ 5 -->
            <div class="accordion-item border">
              <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                  Apakah guru dapat memantau progress siswa?
                </button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Ya, guru memiliki dashboard khusus yang memungkinkan mereka untuk memantau progress setiap siswa, melihat nilai, waktu belajar, dan memberikan bantuan yang diperlukan. Guru juga dapat mengelola kelas dan memberikan tugas tambahan.
                </div>
              </div>
            </div>

            <!-- FAQ 6 -->
            <div class="accordion-item border">
              <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
                  Apakah QuadraLearn gratis untuk digunakan?
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Ya, QuadraLearn adalah platform pembelajaran open-source yang dapat digunakan secara gratis. Platform ini dikembangkan sebagai kontribusi untuk dunia pendidikan di Indonesia dan dapat diakses tanpa biaya berlangganan.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- FAQ: End -->

  <!-- Our great team: Start -->
  <section id="landingTeam" class="section-py landing-team">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Tim Kami</span>
      </div>
      <h3 class="text-center mb-1">Materi dari guru asli</h3>
      <p class="text-center mb-md-5 pb-3">Siapa aja sih yang membuat ini semua?</p>
      <div class="row gy-5 mt-2">
        <div class="col-lg-3 d-none d-lg-block"></div>
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-danger position-relative team-image-box">
              <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/landing-page/team-member-2.png" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="human image" />
            </div>
            <div class="card-body border border-top-0 border-label-danger text-center">
              <h5 class="card-title mb-0">Nur Fitri Yanti, S.Pd.</h5>
              <p class="text-muted mb-0">Guru Komputer</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-primary position-relative team-image-box">
              <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/landing-page/team-member-3.png" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="human image" />
            </div>
            <div class="card-body border border-top-0 border-label-primary text-center">
              <h5 class="card-title mb-0">M. Iqbal Effendi, A.Md.Kom.</h5>
              <p class="text-muted mb-0"><i>Software Engineer</i></p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 d-none d-lg-block"></div>
      </div>
    </div>
  </section>
  <!-- Our great team: End -->

  <!-- CTA: Start -->
  <section id="landingCTA" class="section-py landing-cta position-relative p-lg-0 pb-0">
    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/backgrounds/cta-bg-light.png" class="position-absolute bottom-0 end-0 scaleX-n1-rtl h-100 w-100 z-n1" alt="cta image" data-app-light-img="front-pages/backgrounds/cta-bg-light.png" data-app-dark-img="front-pages/backgrounds/cta-bg-dark.png" />
    <div class="container">
      <div class="row align-items-center gy-5 gy-lg-0">
        <div class="col-lg-6 text-center text-lg-start">
          <h6 class="h2 text-primary fw-bold mb-1">Siap Belajar Fungsi Kuadrat?</h6>
          <p class="fw-medium mb-4">Kalau kamu sudah punya akun, langsung masuk aja.</p>
          <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
        </div>
        <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
          <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/landing-page/cta-dashboard.png" alt="cta dashboard" class="img-fluid" />
        </div>
      </div>
    </div>
  </section>
  <!-- CTA: End -->

  <!-- Contact Us: Start -->
  <section id="landingContact" class="section-py bg-body landing-contact">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Buat Akun</span>
      </div>
      <h3 class="text-center mb-1">Kita buat akun sama-sama</h3>
      <p class="text-center mb-4 mb-lg-5 pb-md-3">Sebelum mulai belajar, kita buat akun dulu ya.</p>
      <div class="row g-4 g-lg-5">
        <div class="col-lg-5">
          <div class="contact-img-box position-relative h-100">
            <img src="https://sman2cirebon.sch.id/wp-content/uploads/2020/07/unbk-715x400.jpeg" alt="anak sma" class="img-fluid w-100 rounded shadow-sm" />
            <div class="mt-4">
              <div class="row g-3">
                <div class="col-12">
                  <div class="d-flex align-items-center p-3 bg-light rounded">
                    <div class="badge bg-label-primary rounded p-2 me-3">
                      <i class="bx bx-envelope"></i>
                    </div>
                    <div>
                      <p class="mb-0 small text-muted">Email</p>
                      <h6 class="mb-0">
                        <a href="mailto:404nf.oa@gmail.com" class="text-heading text-decoration-none">404nf.oa@gmail.com</a>
                      </h6>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="d-flex align-items-center p-3 bg-light rounded">
                    <div class="badge bg-label-success rounded p-2 me-3">
                      <i class="bx bx-phone-call"></i>
                    </div>
                    <div>
                      <p class="mb-0 small text-muted">Phone</p>
                      <h6 class="mb-0">
                        <a href="tel:+6282159142175" class="text-heading text-decoration-none">+62 821 5914 2175</a>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card shadow-sm">
            <div class="card-body p-4 p-lg-5">
              <div class="mb-4">
                <h4 class="mb-2 fw-bold">Adventure starts here 🚀</h4>
                <p class="mb-0 text-muted">Ayo buat akun dan kita mulai perjalanan belajar yang menyenangkan!</p>
              </div>
              
              <form action="{{ route('auth.sign-up') }}" method="POST" class="contact-form">
                @csrf
                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label fw-medium" for="contact-form-fullname">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="contact-form-fullname" 
                           placeholder="Masukkan nama lengkap Anda" 
                           name="name" 
                           value="{{ old('name') }}" />
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-label fw-medium" for="contact-form-nis">NIS <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nis') is-invalid @enderror" 
                           id="contact-form-nis" 
                           name="nis" 
                           placeholder="Masukkan NIS" 
                           value="{{ old('nis') }}" />
                    @error('nis')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-label fw-medium" for="contact-form-email">Email <span class="text-danger">*</span></label>
                    <input type="email" 
                           id="contact-form-email" 
                           name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Masukkan email aktif" 
                           value="{{ old('email') }}" />
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-label fw-medium" for="password">Password <span class="text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                      <input type="password"
                             id="password"
                             class="form-control @error('password') is-invalid @enderror"
                             name="password"
                             placeholder="Minimal 8 karakter"
                             aria-describedby="password" />
                      <span class="input-group-text cursor-pointer">
                        <i class="bx bx-hide"></i>
                      </span>
                    </div>
                    @error('password')
                      <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-label fw-medium" for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                    <div class="input-group input-group-merge">
                      <input type="password"
                             id="password_confirmation"
                             class="form-control @error('password_confirmation') is-invalid @enderror"
                             name="password_confirmation"
                             placeholder="Ulangi password"
                             aria-describedby="password_confirmation" />
                      <span class="input-group-text cursor-pointer">
                        <i class="bx bx-hide"></i>
                      </span>
                    </div>
                    @error('password_confirmation')
                      <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                      <i class="bx bx-user-plus me-2"></i>
                      Buat Akun Sekarang
                    </button>
                  </div>
                  
                  <div class="col-12 text-center">
                    <p class="small text-muted mb-0">
                      Sudah punya akun? 
                      <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-medium">Masuk di sini</a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Us: End -->
</div>

<!-- / Sections:End -->



<!-- Footer: Start -->
<footer class="landing-footer bg-body footer-text">
  <div class="footer-top position-relative overflow-hidden z-1">
    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/backgrounds/footer-bg-light.png" alt="footer bg" class="footer-bg banner-bg-img z-n1" data-app-light-img="front-pages/backgrounds/footer-bg-light.png" data-app-dark-img="front-pages/backgrounds/footer-bg-dark.png" />
    <div class="container">
      <div class="row gx-0 gy-4 g-md-5">
        <div class="col-lg-5">
          <a href="landing-page.html" class="app-brand-link mb-4">
            <span class="app-brand-logo demo"><img src="{{ asset('404_Black.jpg') }}" alt="404 Not Found Indonesia" width="30" style="border-radius: 150px" srcset=""></span>
            <span class="app-brand-text footer-link fw-bold ms-2 ps-1 fs-3">QuadraLearn</span>
          </a>
          <p class="footer-text footer-logo-description mb-4">
            Dikembangkan oleh <b>404 Not Found Indonesia</b> sebagai proyek <i>open-source</i>.
          </p>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <h6 class="footer-title mb-4">Platform</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="#landingFeatures" class="footer-link">Fitur</a>
            </li>
            <li class="mb-2">
              <a href="#landingCurriculum" class="footer-link">Kurikulum</a>
            </li>
            <li class="mb-2">
              <a href="{{ route('login') }}" class="footer-link">Masuk</a>
            </li>
            <li class="mb-2">
              <a href="{{ route('register') }}" class="footer-link">Daftar</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <h6 class="footer-title mb-4">Pembelajaran</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="#landingCurriculum" class="footer-link">Materi</a>
            </li>
            <li class="mb-2">
              <a href="#landingFeatures" class="footer-link">Latihan</a>
            </li>
            <li class="mb-2">
              <a href="#landingFeatures" class="footer-link">Evaluasi</a>
            </li>
            <li class="mb-2">
              <a href="#landingTestimonials" class="footer-link">Testimoni</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4">
          <h6 class="footer-title mb-4">Kontak</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <i class="bx bx-envelope me-2"></i>
              <a href="mailto:404nf.oa@gmail.com" class="footer-link">404nf.oa@gmail.com</a>
            </li>
            <li class="mb-2">
              <i class="bx bx-phone me-2"></i>
              <a href="tel:+6282159142175" class="footer-link">+62 821 5914 2175</a>
            </li>
            <li class="mb-2">
              <i class="bx bx-map me-2"></i>
              <span class="footer-link">Indonesia</span>
            </li>
          </ul>
          <div class="mt-4">
            <h6 class="footer-title mb-2">Ikuti Kami</h6>
            <div class="d-flex gap-2">
              <a href="https://github.com/404NotFoundIndonesia/quadra-learn" class="btn btn-sm btn-outline-primary" target="_blank">
                <i class="bx bx-code-alt"></i>
              </a>
              <a href="https://www.instagram.com/404notfoundindonesia/" class="btn btn-sm btn-outline-primary" target="_blank">
                <i class="bx bx-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom py-3">
    <div class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
      <div class="mb-2 mb-md-0">
        <span class="footer-text">©2024</span>
        <a href="https://github.com/404NotFoundIndonesia" target="_blank" class="fw-medium text-white footer-link">404 Not Found Indonesia,</a>
        <span class="footer-text"> Made with ❤️ for more open-source resource.</span>
      </div>
      <div>
        <a href="https://github.com/404NotFoundIndonesia/quadra-learn" class="footer-link me-3" target="_blank">
          <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/github-light.png" alt="github icon" data-app-light-img="front-pages/icons/github-light.png" data-app-dark-img="front-pages/icons/github-dark.png" />
        </a>
        <a href="https://www.instagram.com/404notfoundindonesia/" class="footer-link" target="_blank">
          <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/instagram-light.png" alt="google icon" data-app-light-img="front-pages/icons/instagram-light.png" data-app-dark-img="front-pages/icons/instagram-dark.png" />
        </a>
      </div>
    </div>
  </div>
</footer>
<!-- Footer: End -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets/js/front-main.js') }}"></script>


  <!-- Page JS -->
  <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>

</body>

</html>
