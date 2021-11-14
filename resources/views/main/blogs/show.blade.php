@extends('main.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
        </ol>
    </nav>
    <div class="container">
        <section class="p-4 mb-3">
            <h1 class="mb-4">{{ $blog->title }}</h1>
            {!! $blog->content !!}
        </section>
        @if(isset($gallery) && is_array($gallery) && count($gallery) > 0)
            <section class="p-4 mb-3">
                <h3>Galeria zdjęć</h3>
                <div>
                    @foreach($gallery as $img)
                        <a href="{{ route('image.show', ['path' => $img['image']]) }}" target="_blank">
                            <img src="{{ route('image.thumbnail', ['path' => $img['image'], 'width' => 150, 'height' => 150]) }}" alt="Zdjęcie">
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
        <section class="p-4 mb-4">
            <p>Dodano: {{ dateTimeFormat(strtotime($blog->created_at)) }}</p>
        </section>
    </div>
@endsection
