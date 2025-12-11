
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ route('welcome') }}" class="app-brand-link">
        <span class="app-brand-logo demo"><img src="{{ asset('404_Black.jpg') }}" alt="404 Not Found Indonesia" width="30" style="border-radius: 150px" srcset=""></span>
        <span class="app-brand-text menu-text fw-bold ms-2 fs-5">QuadraLearn</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      @if(auth()->user()->isStudent())
        <li class="menu-item {{ Route::is('student.dashboard') ? 'active' : '' }}">
          <a href="{{ route('student.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard">Dashboard</div>
          </a>
        </li>
      @elseif(auth()->user()->isAdmin())
        <li class="menu-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard">Dashboard</div>
          </a>
        </li>
      @else
        <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboard">Dashboard</div>
          </a>
        </li>
      @endif

      <li class="menu-item {{ Route::is('profile.*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-dock-top"></i>
            <div data-i18n="Profil">Profil</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Route::is('profile.account') ? 'active' : '' }}">
                <a href="{{ route('profile.account') }}" class="menu-link">
                    <div data-i18n="Akun">Akun</div>
                </a>
            </li>
            <li class="menu-item {{ Route::is('profile.change-password') ? 'active' : '' }}">
                <a href="{{ route('profile.change-password') }}" class="menu-link">
                    <div data-i18n="Ganti Password">Ganti Password</div>
                </a>
            </li>
        </ul>
      </li>

      @if (auth()->user()->isStudent())
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pembelajaran</span>
        </li>

        <li class="menu-item {{ Route::is('student.dashboard') ? 'active' : '' }}">
            <a href="{{ route('student.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-reader"></i>
                <div data-i18n="Materi Pembelajaran">Materi Pembelajaran</div>
            </a>
        </li>

      @else
        @if (auth()->user()->isAdmin())
          <!-- Admin Only Menu -->
          <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Data Master</span>
          </li>

          <li class="menu-item {{ Route::is('admin.students.*') ? 'active' : '' }}">
              <a href="{{ route('admin.students.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-user-circle"></i>
                  <div data-i18n="Siswa">Siswa</div>
              </a>
          </li>

          <li class="menu-item {{ Route::is('admin.teachers.*') ? 'active' : '' }}">
              <a href="{{ route('admin.teachers.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-user-check"></i>
                  <div data-i18n="Guru">Guru</div>
              </a>
          </li>

          <li class="menu-item {{ Route::is('admin.grades.*') ? 'active' : '' }}">
              <a href="{{ route('admin.grades.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-chalkboard"></i>
                  <div data-i18n="Kelas">Kelas</div>
              </a>
          </li>

          <li class="menu-item {{ Route::is('admin.learning-materials.*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-book-content"></i>
                  <div data-i18n="Materi Pembelajaran">Materi Pembelajaran</div>
              </a>
              <ul class="menu-sub">
                  <li class="menu-item {{ Route::is('admin.learning-materials.index') ? 'active' : '' }}">
                      <a href="{{ route('admin.learning-materials.index') }}" class="menu-link">
                          <div data-i18n="Semua Materi">Semua Materi</div>
                      </a>
                  </li>
                  <li class="menu-item {{ Route::is('admin.learning-materials.create') ? 'active' : '' }}">
                      <a href="{{ route('admin.learning-materials.create') }}" class="menu-link">
                          <div data-i18n="Tambah Materi">Tambah Materi</div>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="menu-item {{ Route::is('admin.questions.*') ? 'active open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-help-circle"></i>
                  <div data-i18n="Soal">Soal</div>
              </a>
              <ul class="menu-sub">
                  <li class="menu-item {{ Route::is('admin.questions.index') ? 'active' : '' }}">
                      <a href="{{ route('admin.questions.index') }}" class="menu-link">
                          <div data-i18n="Semua Soal">Semua Soal</div>
                      </a>
                  </li>
                  <li class="menu-item {{ Route::is('admin.questions.create') ? 'active' : '' }}">
                      <a href="{{ route('admin.questions.create') }}" class="menu-link">
                          <div data-i18n="Tambah Soal">Tambah Soal</div>
                      </a>
                  </li>
              </ul>
          </li>
        @endif

      @endif


    </ul>
  </aside>
