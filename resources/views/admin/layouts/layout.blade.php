<!doctype html>

<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description ?? config('sopicms.mta.description') }}">
        <meta name="keywords" content="{{ $keywords ?? config('sopicms.meta.keywords') }}">
        <title>{{ $title ?? config('sopicms.meta.title') }}</title>
        <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header id="header" class="p-3 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-8 col-xl-4">
                        <a href="{{ route('admin.dashboard') }}" id="logo">Panel administracyjny</a>
                    </div>
                    <div class="col-4 col-xl-8">
                        <nav class="navbar navbar-expand">
                            <div class="collapse navbar-collapse" id="menu">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item d-none d-xl-block">
                                        <a href="{{ route('admin.dashboard') }}" class="nav-link{!! Request::url() == route('admin.dashboard') ? ' active' : '' !!}">
                                            Strona główna
                                        </a>
                                    </li>
                                    <li class="nav-item d-none d-xl-block">
                                        <a href="{{ route('home') }}" class="nav-link{!! Request::url() == route('home') ? ' active' : '' !!}">
                                            Powrót do serwisu
                                        </a>
                                    </li>
                                    <li class="nav-item d-none d-xl-block">
                                        <a href="{{ route('user.dashboard') }}"  class="nav-link">
                                            Jesteś zalogowany jako <strong>{{ auth()->user()->name }}</strong>
                                        </a>
                                    </li>
                                    <li class="nav-item ps-3 d-none d-xl-block">
                                        <a href="{{ route('auth.logout') }}" class="btn btn-primary">
                                            Wyloguj się
                                        </a>
                                    </li>
                                    <li class="nav-item ps-3 d-inline d-xl-none">
                                        <a data-bs-toggle="collapse" href="#left-menu" role="button" aria-expanded="false" aria-controls="left-menu" class="btn btn-primary">
                                            Menu
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <main class="p-4">
            <div class="container">
                @yield('content')
            </div>
            <div class="text-center text-light fs-6 p-5">
                Wsparcie techniczne:
                <a href="mailto:kontakt@webhome.pl" class="ms-4 text-light">kontakt@webhome.pl</a>
                <a href="tel:0048887667447" class="ms-4 text-light">+48 887-667-447</a>
                <a href="https://webhome.pl" class="ms-4 text-light" target="_blank">webhome.pl</a>
            </div>
        </main>
        <script src="{{ asset('js/admin/app.js') }}"></script>
    </body>
</html>
