<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" integrity="sha512-UwbBNAFoECXUPeDhlKR3zzWU3j8ddKIQQsDOsKhXQGdiB5i3IHEXr9kXx82+gaHigbNKbTDp3VY/G6gZqva6ZQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('head-script')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home.index') }}">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="{{ (request()->is('/')) ? 'nav-link active' : 'nav-link' }}" href="{{ route('home.index') }}">{{__('layoutmessages.Home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="{{ (request()->routeIs('exercise.*')) ? 'nav-link active' : 'nav-link' }}" href="{{ route('exercise.index') }}">{{__('layoutmessages.Exercises')}}</a>
                </li>
                <li class="nav-item">
                    <a class="{{ (request()->routeIs('workout.*')) ? 'nav-link active' : 'nav-link' }}" href="{{ route('workout.index') }}">{{ __('wmessages.Title') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">

                @role('role_superadmin')
                <li class="nav-item">
                    <a class="{{ (request()->routeIs('admin.*')) ? 'nav-link active' : 'nav-link' }}" href="{{ route('admin.index') }}">Admin</a>
                </li>
                @endrole

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"  role="button" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach (config('languages') as $lang => $language)
                            @if ($lang != \Illuminate\Support\Facades\App::getLocale())
                                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a>
                            @endif
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" onclick="event.preventDefault();  document.getElementById('logout-form').submit();" href="#">
                        {{ __('layoutmessages.Logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-2">

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="row">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>


@yield('content')
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@stack('foot-script')
</body>
</html>
