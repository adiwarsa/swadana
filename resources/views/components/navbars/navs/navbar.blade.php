<style>
  .logo-pub{
    font-family: 'ITC Avant Garde Gothic W01','Museo Sans','helvetica neue',helvetica;
    font-size: larger;
    font-weight: bold;
    color:black;
  }
</style>
<header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="{{ route('pub-index') }}" class="logo-pub">
        Swadana
      </a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">
          <li>
            <a href="{{ request()->is('/') ? '#' : route('pub-index') }}" class="navbar-link" data-nav-link>Home</a>
          </li>
          <li>
            <a href="{{ request()->is('/') ? '#featured-car' : route('pub-index').'#featured-car' }}" class="navbar-link" data-nav-link>Explore cars</a>
          </li>
          <li>
            <a href="{{ request()->is('/') ? '#featured-motor' : route('pub-index').'#featured-motor' }}" class="navbar-link" data-nav-link>Explore motorcycle</a>
          </li>
        </ul>
      </nav>
    
    @guest
      <div class="header-actions">
        <a href="{{ route('register') }}" class="btn btn-primary" aria-labelledby="aria-label-txt-regis">
            <span id="aria-label-txt-regis">Register</span>
          </a>
        <a href="{{ route('login') }}" class="btn btn-primary" aria-labelledby="aria-label-txt">
          <span id="aria-label-txt">Login</span>
        </a>

      </div> 
    @endguest

    @auth
    <div class="header-actions">
    <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
        @csrf
    </form>
    <a href="{{ route('cus-dashboard') }}" class="btn btn-primary" aria-labelledby="aria-label-txt-regis">
      <span id="aria-label-txt-regis">Cart</span>
    </a>
    <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Hi, {{ Auth::user()->username }}
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('customer-profile') }}">Settings</a>
        <a class="dropdown-item" href="javascript:;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
      </div>
    </div>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>

        {{-- <li class="nav-item d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                    Out</span>
            </a>
        </li>        --}}
    @endauth
    </div>
  </header>
