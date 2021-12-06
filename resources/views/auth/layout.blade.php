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
    <body id="auth" class="d-flex flex-column min-vh-100">
        <main id="main" class="p-3">
            <div class="container">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </main>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/lightbox.js') }}"></script>
    </body>
</html>
