@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.list') }}">Treści</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.blog.list') }}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="row">
        <div id="left" class="col-xl-3 col-sm-12">
            @include('admin.layouts.left')
        </div>
        <div id="right" class="col-xl-9 col-sm-12">
            <div class="accordion accordion-flush" id="section-list">

                <div class="accordion-item mb-4">
                    <h1 class="accordion-header" id="section-1">
                        <button class="accordion-button text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-1-container" aria-expanded="false" aria-controls="section-1-container">
                            {{ $title }}
                        </button>
                    </h1>
                    <div id="section-1-container" class="accordion-collapse collapse show" aria-labelledby="section-1">
                        <section class="accordion-body p-4">
                            @include('main.layouts.alert')

                            <form method="post" action="{{ route('admin.blog.edit.send', ['id' => $id]) }}">
                                @csrf
                                <label>
                                    Tytuł strony
                                    <input type="text" name="title" required="required" value="{{ old('title', $blog->title) }}" class="@error('title') is-invalid @enderror">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            Opis
                                            <input type="text" name="description" value="{{ old('description', $blog->description) }}" maxlength="255" class="@error('description') is-invalid @enderror">
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label>
                                            Słowa kluczowe
                                            <input type="text" name="keywords" value="{{ old('keywords', $blog->keywords) }}" maxlength="255" class="@error('keywords') is-invalid @enderror">
                                            @error('keywords')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <label>
                                    Treść
                                    <textarea name="content" class="@error('content') is-invalid @enderror">{{ old('content', $blog->content) }}</textarea>
                                    @error('content')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="Zapisz" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-2">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-2-container" aria-expanded="false" aria-controls="section-2-container">
                            Galeria zdjęć
                        </button>
                    </h2>
                    <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                        <section class="accordion-body p-4">
                            @if(isset($blog->gallery) && is_array($blog->gallery) && count($blog->gallery) > 0)
                                <div class="mb-5">
                                    <p>Kliknij na zdjęciu by wyświetlić więcej opcji</p>
                                    @foreach($blog->gallery as $key => $img)
                                        <a href="#" class=dropdown-toggle" role="button" id="aaa{{ $key }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ route('image.thumbnail', ['path' => $img, 'width' => 150, 'height' => 150]) }}" alt="Zdjęcie">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="aaa{{ $key }}">
                                            @if($key > 0)<li><a href="{{ route('admin.blog.gallery.cover.send', ['id' => $id, 'key' => $key]) }}" class="dropdown-item">Ustaw jako zdjęcie główne</a></li>@endif
                                            <li><a href="{{ route('image.show', ['path' => $img]) }}" class="dropdown-item" target="_blank">Pokaż zdjęcie</a></li>
                                            <li><a href="{{ route('admin.blog.gallery.delete.send', ['id' => $id, 'key' => $key]) }}" class="dropdown-item">Usuń zdjęcie</a></li>
                                        </ul>
                                    @endforeach
                                </div>
                            @else
                                <p>Nie dodano jeszcze żadnego zdjęcia</p>
                            @endif
                            <form method="post" action="{{ route('admin.blog.gallery.send', ['id' => $id]) }}" enctype="multipart/form-data">
                                @csrf
                                <label>
                                    Plik graficzny
                                    <input type="file" name="file" required="required" class="@error('file') is-invalid @enderror">
                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="Dodaj zdjęcie" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-3">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-3-container" aria-expanded="false" aria-controls="section-3-container">
                            Usuń
                        </button>
                    </h2>
                    <div id="section-3-container" class="accordion-collapse collapse" aria-labelledby="section-3">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.blog.delete.send', ['id' => $id]) }}">
                                @csrf
                                <label>
                                    <input type="checkbox" name="delete" value="1" required="required">
                                    Potwierdzam chęć usunięcia tego wpisu
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="Usuń" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
