@extends('main.layouts.layout')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog') }}">{{ __('blog.header.title') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                @include('main.layouts.left')
            </div>
            <div class="col-xl-9 col-sm-12">
                <section class="p-4 mb-3">
                    <h1 class="mb-4">{{ $blog->title }}</h1>
                    {!! $blog->content !!}
                    <p class="mt-4 fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill me-2" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        </svg>
                        {{ dateTimeFormat(strtotime($blog->created_at)) }}
                    </p>
                    @if(isset($gallery) && is_array($gallery) && count($gallery) > 0)
                        <div class="mt-4 mb-4">
                            <div>
                                @foreach($gallery as $img)
                                    <a href="{{ route('image.show', ['path' => $img['image']]) }}" data-lightbox="gallery">
                                        <img src="{{ route('image.thumbnail', ['path' => $img['image'], 'width' => 200, 'height' => 150]) }}" alt="{{ $blog->title }}" class="img-thumbnail">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
@endsection
