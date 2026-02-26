<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-3">
      <div class="container">
        <!-- LOGO -->
        <a
          class="navbar-brand d-flex align-items-center gap-2"
          href="{{ route('home') }}"
        >
          <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo" class="main-logo" />
        </a>

        <!-- TOGGLER -->
        <button
          class="navbar-toggler border-0"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto align-items-center gap-lg-2">
            <li class="nav-item">
              <a class="nav-link" href="offline.html">Offline Courses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="online.html">Online Courses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="current-affairs.html"
                >Daily Current Affairs</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('blogs') }}">Blogs</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>


            <!-- DROPDOWN -->
            <li class="nav-item dropdown ms-lg-2">
              <a
                class="nav-link dropdown-toggle more-link"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
              >
                More Services
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                <li><a class="dropdown-item" href="#">Coupon</a></li>
                <li><a class="dropdown-item" href="#">Coins</a></li>
                <li><a class="dropdown-item" href="#">Scholarship</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Purchase / My Order</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>