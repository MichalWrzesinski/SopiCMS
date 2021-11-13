@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.list') }}">Treści</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.list') }}">Strony</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="row">
        <div id="left" class="col-xl-3 col-sm-12">
            @include('admin.layouts.left')
        </div>
        <div id="right" class="col-xl-9 col-sm-12">
            <section class="p-4 mb-3">
                <h1 class="mb-4">{{ $title }}</h1>
                @include('main.layouts.alert')

                <form method="post" action="{{ route('admin.pages.edit.send', ['id' => $id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>
                                Tytuł strony
                                <input type="text" name="title" required="required" value="{{ old('title', $page->title) }}" class="@error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="col">
                            <label>
                                Adres url
                                <input type="text" name="url" required="required" value="{{ old('url', $page->url) }}" class="@error('url') is-invalid @enderror">
                                @error('url')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>
                                Opis
                                <input type="text" name="description" value="{{ old('description', $page->description) }}" maxlength="255" class="@error('description') is-invalid @enderror">
                                @error('description')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="col">
                            <label>
                                Słowa kluczowe
                                <input type="text" name="keywords" value="{{ old('keywords', $page->keywords) }}" maxlength="255" class="@error('keywords') is-invalid @enderror">
                                @error('keywords')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <label>
                        Treść
                        <textarea name="content" class="@error('content') is-invalid @enderror">{{ old('content', $page->content) }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </label>
                    <div class="mt-4">
                        <input type="submit" value="Zapisz" class="btn btn-primary">
                    </div>
                </form>
            </section>
            <section class="p-4 mb-3">
                <h2>Galeria zdjęć</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-2" role="button" aria-expanded="false" aria-controls="collapse-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-2" class="collapse mt-4">
                    @if(isset($page->gallery) && is_array($page->gallery) && count($page->gallery) > 0)
                        <div class="mb-5">
                            <p>Kliknij na zdjęciu by wyświetlić więcej opcji</p>
                            @foreach($page->gallery as $key => $img)
                                <a href="#" class=dropdown-toggle" role="button" id="aaa{{ $key }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ route('image.thumbnail', ['path' => $img, 'width' => 150, 'height' => 150]) }}" alt="Zdjęcie">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="aaa{{ $key }}">
                                    @if($key > 0)<li><a href="{{ route('admin.pages.gallery.cover.send', ['id' => $id, 'key' => $key]) }}" class="dropdown-item">Ustaw jako zdjęcie główne</a></li>@endif
                                    <li><a href="{{ route('image.show', ['path' => $img]) }}" class="dropdown-item" target="_blank">Pokaż zdjęcie</a></li>
                                    <li><a href="{{ route('admin.pages.gallery.delete.send', ['id' => $id, 'key' => $key]) }}" class="dropdown-item">Usuń zdjęcie</a></li>
                                </ul>
                            @endforeach
                        </div>
                    @else
                        <p>Nie dodano jeszcze żadnego zdjęcia</p>
                    @endif
                    <form method="post" action="{{ route('admin.pages.gallery.send', ['id' => $id]) }}" enctype="multipart/form-data">
                        @csrf
                        <label>
                            Plik graficzny
                            <input type="file" name="file" required="required" class="@error('file') is-invalid @enderror">
                            @error('file')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </label>
                        <div class="mt-4">
                            <input type="submit" value="Dodaj zdjęcie" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </section>
            <section class="p-4 mb-3">
                <h2>Usuń stronę</h2>
                <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </a>
                <div id="collapse-1" class="collapse mt-4">
                    @if($page->constant == 1)
                        <p>Tej strony nie można usunąć</p>
                    @else
                        <form method="post" action="{{ route('admin.pages.delete.send', ['id' => $id]) }}">
                            @csrf
                            <label>
                                <input type="checkbox" name="delete" value="1" required="required" class="@error('delete') is-invalid @enderror">
                                Potwierdzam chęć usunięcia tej strony
                                @error('delete')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </label>
                            <div class="mt-4">
                                <input type="submit" value="Usuń" class="btn btn-primary">
                            </div>
                        </form>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
