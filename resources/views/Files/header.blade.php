<header class="bg-white shadow-sm">
    <nav class="navbar navbar-expand-lg py-0">
      <div class="container">
        <a class="navbar-brand py-0 text-decoration-none gap-2 d-flex align-items-center mb-2" href="{{ url('/') }}">
          {{-- <img src="{{ asset('icons/Concrete-icon.svg') }}" alt="Logo" class="logo" width="auto" height="55px"> --}}
          <span class="fs-5 lh-sm clr mt-2"><span class="text-dark">Blog</span><br>System</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item position-relative {{ request()->Is('/') ? 'active' : '' }}">
              <a class="nav-link rounded-pill px-3 " href="{{ url('/') }}">Home</a>
              </li>
            {{-- <li class="nav-item position-relative {{ request()->Is('-calculator') ? 'active' : '' }}">
              <a class="nav-link rounded-pill px-3" href="{{ url('-calculator') }}">Brick Calculator</a>
            </li> --}}
            <li class="nav-item position-relative {{ request()->Is('register') ? 'active' : '' }}">
                <a class="nav-link rounded-pill px-3" href="{{ url('register') }}">Register</a>
            </li>
            <li class="nav-item position-relative {{ request()->Is('login') ? 'active' : '' }}">
              <a class="nav-link rounded-pill px-3" href="{{url('login')}}">Login</a>
            </li>
            @if(isset($local_lang))
            <li class="nav-item dropdown pe-0 localizedMenu">
              <a class="nav-link dropdown-toggle" id="localizedMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-language text-light font16" aria-hidden="true"></i>
                {{ strtoupper($lang_u) }}
              </a>
              <ul class="dropdown-menu p-0" aria-labelledby="localizedMenu">
                @php
                  $local_links = explode('</li>', $local_lang);
                  $local = 0;
                  echo '<table class="table table-bordered m-0" width="100%">';
                  foreach ($local_links as $key => $value) {
                    if(($local == 0) & !empty($value)){
                      echo '<tr class="border-bottom">';
                    }

                    $local++;

                    if(($local < 3) & !empty($value)){
                      echo '<td class="text-center border-0">' . $value . '</td>';
                    }
                    if(($local == 3) & !empty($value)){
                      echo '<td class="text-center border-0">' . $value . '</td>
                      
                      </tr>';
                      $local = 0;
                    }
                  }
                  echo '</table>';
                @endphp
              </ul>
            </li>
          @endif
          </ul>
        </div>
      </div>
    </nav>
  </header>
  