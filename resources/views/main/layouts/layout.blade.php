<!doctype html>

<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $description ?? config('sopicms.mta.description') }}">
        <meta name="keywords" content="{{ $keywords ?? config('sopicms.meta.keywords') }}">
        <title>{{ $title ?? config('sopicms.meta.title') }}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
    </head>
    <body class="d-flex flex-column min-vh-100">
        <header id="header" class="p-3">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <a href="{{ route('home') }}" id="logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-stack me-2" viewBox="0 0 16 16">
                                <path d="m14.12 10.163 1.715.858c.22.11.22.424 0 .534L8.267 15.34a.598.598 0 0 1-.534 0L.165 11.555a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.66zM7.733.063a.598.598 0 0 1 .534 0l7.568 3.784a.3.3 0 0 1 0 .535L8.267 8.165a.598.598 0 0 1-.534 0L.165 4.382a.299.299 0 0 1 0-.535L7.733.063z"/>
                                <path d="m14.12 6.576 1.715.858c.22.11.22.424 0 .534l-7.568 3.784a.598.598 0 0 1-.534 0L.165 7.968a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.659z"/>
                            </svg>
                            {{ config('sopicms.siteName') }}
                        </a>
                    </div>
                    <div class="col-8">
                        <nav class="navbar navbar-expand-lg">
                            <div class="collapse navbar-collapse" id="menu">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="{{ route('home') }}" class="nav-link{!! Request::url() == route('home') ? ' active' : '' !!}">
                                            {{ __('layout.header.home') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('item.list') }}" class="nav-link{!! Request::url() == route('item.list') ? ' active' : '' !!}">
                                            {{ __('items.header.title') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('blog') }}" class="nav-link{!! Request::url() == route('blog') ? ' active' : '' !!}">
                                            {{ __('blog.header.title') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('contact') }}" class="nav-link{!! Request::url() == route('contact') ? ' active' : '' !!}">
                                            {{ __('contact.header.title') }}
                                        </a>
                                    </li>
                                    @auth
                                        <li class="nav-item">
                                            <a href="{{ route('auth.logout') }}" class="nav-link{!! Request::url() == route('auth.logout') ? ' active' : '' !!}">
                                                {{ __('user.header.logout') }}
                                            </a>
                                        </li>
                                        <li class="nav-item ps-3 position-relative">
                                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                                                {{ __('user.header.title') }}
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a href="{{ route('auth.register') }}" class="nav-link{!! Request::url() == route('auth.register') ? ' active' : '' !!}">
                                                {{ __('auth.header.register') }}
                                            </a>
                                        </li>
                                        <li class="nav-item ps-3">
                                            <a href="{{ route('auth.login') }}" class="btn btn-primary">
                                                {{ __('auth.header.login') }}
                                            </a>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                            <button class="navbar-toggler btn btn-primary float-end" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Pokaż menu">
                                {{ __('layout.header.menu') }}
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        @if(Request::url() == route('home'))
             <main id="main" class="index">
                 @yield('content')
             </main>
        @else
            <main id="main" class="p-3">
                <div class="container">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </main>
        @endif
        <footer id="footer" class="mt-auto p-3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-sm-12 align-self-center">
                        <div id="copyright">
                            Copyright {{ date('Y') }} by <a href="{{ config('APP_URL') }}">{{ config('sopicms.siteName') }}</a>
                        </div>
                    </div>
                    <div class="col-xl-6 cols-sm-12">
                        <nav class="navbar navbar-expand-lg">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="{{ route('home') }}" class="nav-link">
                                        {{ __('layout.header.home') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('page.show', ['url' => config('sopicms.url.regulations')]) }}" class="nav-link">
                                        {{ __('layout.header.regulations') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('page.show', ['url' => config('sopicms.url.privacyPolicy')]) }}" class="nav-link">
                                        {{ __('layout.header.policy') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact') }}" class="nav-link">
                                        {{ __('contact.header.title') }}
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div id="social-media">
                            <nav class="navbar navbar-expand-lg">
                                <ul class="navbar-nav ms-auto">
                                    @if(!empty(config('settings.socialmedia.facebook')))
                                    <li class="nav-item">
                                        <a href="{{ config('settings.socialmedia.facebook') }}" class="nav-link" title="{{ __('layout.button.facebook') }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty(config('settings.socialmedia.twitter')))
                                    <li class="nav-item">
                                        <a href="{{ config('settings.socialmedia.twitter') }}" class="nav-link" title="{{ __('layout.field.twitter') }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty(config('settings.socialmedia.youtube')))
                                    <li class="nav-item">
                                        <a href="{{ config('settings.socialmedia.youtube') }}" class="nav-link" title="{{ __('layout.field.youtube') }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty(config('settings.socialmedia.instagram')))
                                    <li class="nav-item">
                                        <a href="{{ config('settings.socialmedia.instagram') }}" class="nav-link" title="{{ __('layout.field.instagram') }}" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    @endif
                                    @if(!empty(config('settings.socialmedia.linkedin')))
                                        <li class="nav-item">
                                            <a href="{{ config('settings.socialmedia.linkedin') }}" class="nav-link" title="{{ __('layout.field.linkedin') }}" target="_blank">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                                </svg>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/lightbox.js') }}"></script>
    </body>
</html>
