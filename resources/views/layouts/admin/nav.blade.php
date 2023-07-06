<header class="app-header"><a class="app-header__logo" href="index.html">PohnchaDoo</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <!-- User Menu-->
      <li class="dropdown">
        <a class="app-nav__item" href="#" data-toggle="dropdown">
          <i class="fa fa-user fa-lg"></i> {{ Auth::user()->last_name }} <i class="fa fa-caret-down"></i>
      </a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out fa-lg"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </li>
    </ul>
</header>