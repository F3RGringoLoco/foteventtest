<nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">FotEventos</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
            @else
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('picture.index') }}">{{ __('Mi Galería') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('event.index') }}">{{ __('Explorar Eventos') }}</a>
                    </li>

                    {{--<li class="nav-item">
                        <a class="nav-link" href="{{ route('nivel3.index') }}">{{ __('Nivel 3 (Componentes)') }}</a>
                    </li>--}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown1">
                        <li>
                            <a class="dropdown-item" href="{{ route('user.show', Auth::id()) }}">
                                {{ __('Mi Cuenta') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('trans.index', Auth::id()) }}">
                                {{ __('Transacciones') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </li>
            @endguest
          </ul>
        </div>
      </div>
    </div>
  </nav>
