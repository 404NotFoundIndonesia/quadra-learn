
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
      <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Basic">Dashboard</div>
        </a>
      </li>

      @if (auth()->user()->isStudent())



      @else

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Data Master</span>
        </li>


        <li class="menu-item {{ Route::is('students.*') ? 'active' : '' }}">
            <a href="{{ route('students.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Siswa">Siswa</div>
            </a>
        </li>

      @endif


    </ul>
  </aside>
