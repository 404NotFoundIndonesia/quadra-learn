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
            <a class="nav-link fw-medium" href="#landingFeatures">Fitur Unggulan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="#landingTeam">Tim Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="#landingContact">Buat Akun</a>
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

  <!-- Useful features: Start -->
  <section id="landingFeatures" class="section-py landing-features">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Fitur Unggulan</span>
      </div>
      <h3 class="text-center mb-1">Semua yang kamu butuhkan untuk belajar</h3>
      <p class="text-center mb-3 mb-md-5 pb-3">
        Bukan cuma sekadar situs web, kami menyediakan aplikasi web untuk belajar Fungsi Kuadrat.
      </p>
      <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/laptop.png" alt="laptop charging" />
          </div>
          <h5 class="mb-3">Quality Code</h5>
          <p class="features-icon-description">
            Code structure that all Tim Kamis will easily understand and fall in love with.
          </p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/rocket.png" alt="transition up" />
          </div>
          <h5 class="mb-3">Continuous Updates</h5>
          <p class="features-icon-description">
            Free updates for the next 12 months, including new demos and features.
          </p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/paper.png" alt="edit" />
          </div>
          <h5 class="mb-3">Stater-Kit</h5>
          <p class="features-icon-description">
            Start your project quickly without having to remove unnecessary features.
          </p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/check.png" alt="3d select solid" />
          </div>
          <h5 class="mb-3">API Ready</h5>
          <p class="features-icon-description">
            Just change the endpoint and see your own data loaded within seconds.
          </p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/user.png" alt="lifebelt" />
          </div>
          <h5 class="mb-3">Excellent Support</h5>
          <p class="features-icon-description">An easy-to-follow doc with lots of references and code examples.</p>
        </div>
        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
          <div class="text-center mb-3">
            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/keyboard.png" alt="google docs" />
          </div>
          <h5 class="mb-3">Well Documented</h5>
          <p class="features-icon-description">An easy-to-follow doc with lots of references and code examples.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Useful features: End -->

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
      <div class="row gy-4">
        <div class="col-lg-5">
          <div class="contact-img-box position-relative border p-2 h-100">
            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/icons/contact-border.png" alt="contact border" class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" />
            <img src="https://sman2cirebon.sch.id/wp-content/uploads/2020/07/unbk-715x400.jpeg" alt="anak sma" class="contact-img w-100 scaleX-n1-rtl" />
            <div class="pt-3 px-4 pb-1">
              <div class="row gy-3 gx-md-4">
                <div class="col-md-6 col-lg-12 col-xl-6">
                  <div class="d-flex align-items-center">
                    <div class="badge bg-label-primary rounded p-2 me-2"><i class="bx bx-envelope bx-sm"></i></div>
                    <div>
                      <p class="mb-0">Email</p>
                      <h5 class="mb-0">
                        <a href="mailto:404nf.oa@gmail.com" class="text-heading">404nf.oa@gmail.com</a>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-12 col-xl-6">
                  <div class="d-flex align-items-center">
                    <div class="badge bg-label-success rounded p-2 me-2">
                      <i class="bx bx-phone-call bx-sm"></i>
                    </div>
                    <div>
                      <p class="mb-0">Phone</p>
                      <h5 class="mb-0"><a href="tel:+6282159142175" class="text-heading">+62 821 5914 2175</a></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-1">Adventure starts here 🚀</h4>
              <p class="mb-4">Ayo buat akun dan kita mulai perjalanan kita!</p>
              <form action="{{ route('auth.sign-up') }}" method="POST">
                @csrf
                <div class="row g-4">
                  <div class="col-md-12">
                    <label class="form-label" for="contact-form-fullname">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="contact-form-fullname" placeholder="Masukkan Nama Lengkap" name="name" />
                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="contact-form-fullname">NIS</label>
                    <input type="text" class="form-control @error('nis') is-invalid @enderror" id="contact-form-nis" name="nis" placeholder="Masukkan NIS" />
                    <span class="error invalid-feedback">{{ $errors->first('nis') }}</span>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="contact-form-email">Email</label>
                    <input type="email" id="contact-form-email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" />
                    <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                  </div>
                  <div class="col-md-6 form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                    </div>
                  </div>
                  <div class="col-md-6 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password_confirmation" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Buat Akun</button>
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
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
        </div>
        <div class="col-lg-3 col-md-4">
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
