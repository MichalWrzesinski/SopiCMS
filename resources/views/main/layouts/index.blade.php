@extends('main.layouts.default')

@section('content')
    <div id="slider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/1.jpg') }}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <div class="row">
                        <div class="col">
                            <h3>First slide label</h3>
                            <p>Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</p>
                            <a href="#" class="btn btn-primary btn-lg">Zaczynamy</a>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/2.jpg') }}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <div class="row">
                        <div class="col">
                            <h3>First slide label</h3>
                            <p>Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</p>
                            <a href="#" class="btn btn-primary btn-lg">Zaczynamy</a>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/3.jpg') }}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <div class="row">
                        <div class="col">
                            <h3>First slide label</h3>
                            <p>Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</p>
                            <a href="#" class="btn btn-primary btn-lg">Zaczynamy</a>
                        </div>
                        <div class="col">

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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                    </svg>
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
