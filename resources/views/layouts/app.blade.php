<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  </head>

  <body>
    <div id="app">
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
          <a class="navbar-brand fw-bold" href="{{ url('/') }}"
            style="background-color: rgb(197, 30, 197); color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">
            EduManage
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
              <!-- Authentication Links -->
              @guest
                @if (Route::has('login'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                @endif

                @if (Route::has('showregister'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('showregister') }}">{{ __('Register') }}</a>
                  </li>
                @endif
              @else
                <li class="nav-item dropdown">
                  <div class="d-flex dropdown-toggle align-items-center " data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" v-pre>
                    <img src="/{{ Auth::user()->picture }}" alt="userProfile"
                      style="width: 30px; height:30px;border-radius:50%">
                    <a id="navbarDropdown" class="nav-link  fw-bolder" href="#" role="button">
                      {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
                    </a>
                  </div>

                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <span class="dropdown-item fw-bolder">
                      {{ Auth::user()->role->name }}
                      @if (Auth::user()->active == 0)
                        <span class="text-danger"> ( Not activated )</span>
                      @elseif (Auth::user()->active == 1)
                        <span class="text-success"> ( Activated )</span>
                      @endif
                    </span>

                    <a href="{{ url('/home') }}" class="dropdown-item fw-bold">Home</a>
                    <a href="{{ route('user.modifyUser', Auth()->user()) }}" class="dropdown-item fw-bold">
                      Account
                    </a>
                    @if (Auth::user()->role->name === 'sysAdmin')
                      <a href="{{ route('admin.directorsList') }}" class="dropdown-item fw-bold">Directeurs List</a>
                      <a href="{{ route('admin.schoolsList') }}" class="dropdown-item fw-bold">Schools List</a>
                    @endif

                    @if (Auth::user()->role->name === 'Director' && Auth::user()->active === 1)
                      <a href="{{ route('director.showProfessorsList') }}" class="dropdown-item fw-bold">Professors
                        list</a>
                      <a href="{{ route('director.showStudentsList') }}" class="dropdown-item fw-bold">Students list</a>

                      <a href="{{ route('director.showGroupsList') }}" class="dropdown-item fw-bold">Groups list</a>

                      <a href="{{ route('director.showOptionsList') }}" class="dropdown-item fw-bold">Options list</a>

                      <a href="{{ route('director.showModulesList') }}" class="dropdown-item fw-bold">Modules list</a>
                    @endif

                    @if (Auth::user()->role->name === 'Professor' && Auth::user()->active === 1)
                      <a href="{{ route('professor.showExamsList') }}" class="dropdown-item fw-bold">Exams list</a>
                    @endif


                    <a class="dropdown-item fw-bolder" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </li>
              @endguest
            </ul>
          </div>
        </div>
      </nav>

      <main class="py-4">
        @yield('content')
      </main>
    </div>
  </body>

</html>
