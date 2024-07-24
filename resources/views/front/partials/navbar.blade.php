<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">{{ $general->site_title }}</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0"></div>
               @php
                    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
                @endphp

                @if ($currentRoute === 'login')
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                        Register<i class="fa fa-arrow-right ms-3"></i>
                    </a>
                @elseif ($currentRoute === 'register')
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                        Login<i class="fa fa-arrow-right ms-3"></i>
                    </a>
                @endif
                @if(auth()->guard('client')->check())
                    <a href="{{ route('logout') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                        Logout<i class="fa fa-arrow-right ms-3"></i>
                    </a>
                @endif
            </div>
        </nav>