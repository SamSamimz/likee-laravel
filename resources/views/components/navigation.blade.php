<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active rounded bg-white text-info" aria-current="page" href="{{ route('home') }}"><ion-icon name="home"></ion-icon></a>
          </li>
        </ul>
        @auth
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{-- <ion-icon name="person-circle-outline"></ion-icon> --}}
                <img style="width:45px;height:45px;border-radius:50%" src="{{$profilePic}}" alt="{{$profilePic}}">
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
              <li><a class="dropdown-item" href="{{ route('profile.settings') }}">Settings</a></li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item d-flex align-items-center gap-2"><ion-icon size="small" name="log-out-outline"></ion-icon>Logout</button>
            </form>
            </ul>
          </d>
      </div>
      @else
      <div>
          <a href="{{route('login')}}" class="btn btn-primary">Login</a>
          <a href="{{route('register')}}" class="btn btn-primary">Register</a>
        </div>
        @endauth
    </div>
  </nav>