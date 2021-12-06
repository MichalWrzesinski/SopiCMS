@extends('main.layouts.layout')

@section('content')
    <div id="slider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/slider-1.jpg') }}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="col">
                            <h3>First slide label</h3>
                            <p>Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</p>
                            <a href="#" class="btn btn-primary btn-lg">Zaczynamy</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/slider-1.jpg') }}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="col">
                            <h3>First slide label</h3>
                            <p>Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</p>
                            <a href="#" class="btn btn-primary btn-lg">Zaczynamy</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/slider-1.jpg') }}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block text-dark">
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="col">
                            <h3>First slide label</h3>
                            <p>Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</p>
                            <a href="#" class="btn btn-primary btn-lg">Zaczynamy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Wstecz</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Dalej</span>
        </button>
    </div>

    @if(isset($category))
        <div id="bar" class="p-5">
            <div class="container">
                <div class="row text-center mb-4">
                    <h3>Kategorie</h3>
                    <p>
                        Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui,<br>
                        non felis. Maecenas malesuada elit lectus felis.
                    </p>
                </div>
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav mx-auto">
                        @foreach($category as $cat)
                            <li id="category-{{ $cat['id'] }}" class="nav-item">
                                <a href="{{ route('item.list', ['search' => config('sopicms.opd.category').'/'.$cat['id']]) }}" class="nav-link">
                                    @if($cat['id'] == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                    @endif
                                    @if($cat['id'] == 2)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
                                            </svg>
                                    @endif
                                    @if($cat['id'] == 3)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-handbag" viewBox="0 0 16 16">
                                                <path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6h4z"/>
                                            </svg>
                                    @endif
                                    @if($cat['id'] == 4)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                    @endif
                                    @if($cat['id'] == 5)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                        </svg>
                                    @endif

                                    {{ $cat['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    @endif

    @if(isset($premium))
        <div id="items-promote-section" class="p-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <h3>Prmowane ogłoszenia</h3>
                    <p>
                        Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui,<br>
                        non felis. Maecenas malesuada elit lectus felis.
                    </p>
                </div>
                <div class="row">
                    @foreach($premium as $item)
                        <div class="col-xl-3 col-md-6 mb-4">
                            @include('main.items.block', ['item' => $item, 'cover' => $gallery['premium'][$item->id]])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if(config('settings.ads.block1'))
        <div id="block-1" class="pb-5">
            <div class="container">
                {!! config('settings.ads.block1') !!}
            </div>
        </div>
    @endif

    @if(isset($new))
        <div id="items-new-section" class="p-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <h3>Nowe ogłoszenia</h3>
                    <p>
                        Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui,<br>
                        non felis. Maecenas malesuada elit lectus felis.
                    </p>
                </div>
                <div class="row">
                    @foreach($new as $item)
                        <div class="col-xl-3 col-md-6 mb-4">
                            @include('main.items.block', ['item' => $item, 'cover' => $gallery['new'][$item->id]])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if(config('settings.ads.block2'))
        <div id="block-2" class="pb-5">
            <div class="container">
                {!! config('settings.ads.block2') !!}
            </div>
        </div>
    @endif

    @if(!empty($blog[0]))
        <div id="blog-section" class="p-5">
            <div class="container">
                <div class="row text-center mb-5">
                    <h3>Blog</h3>
                    <p>
                        Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui,<br>
                        non felis. Maecenas malesuada elit lectus felis.
                    </p>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-sm-12">
                        <h3>{{ $blog[0]['title'] }}</h3>
                        <p>{{ $blog[0]['description'] }}</p>
                        <a href="{{ $blog[0]['url']}}" class="btn btn-primary btn-lg">Czytaj całość</a>
                        @if(!empty($blog[1]))
                            <ul class="list mt-5">
                                @foreach($blog as $blogValue)
                                    @if(!$loop->first)
                                        <li><a href="{{ $blogValue->url }}">{{ $blogValue['title'] }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="col-xl-6 col-sm-12">
                        @if($gallery['blog'][$blog[0]->id])
                            <a href="{{ $blog[0]->url }}">
                                <img src="{{ route('image.thumbnail', ['path' => $gallery['blog'][$blog[0]->id], 'width' => 640, 'height' => 480]) }}" alt="{{ $blog[0]['title'] }}" class="img-fluid">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection
