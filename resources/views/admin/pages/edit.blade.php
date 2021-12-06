@extends('admin.layouts.layout')

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
            <div class="accordion accordion-flush" id="section-list">

                <div class="accordion-item mb-4">
                    <h1 class="accordion-header" id="section-1">
                        <button class="accordion-button text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-1-container" aria-expanded="false" aria-controls="section-1-container">
                            {{ $title }}
                        </button>
                    </h1>
                    <div id="section-1-container" class="accordion-collapse collapse show" aria-labelledby="section-1">
                        <section class="accordion-body p-4">
                            @include('tools.alert')

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
                            @if(isset($gallery) && is_array($gallery) && count($gallery) > 0)
                                <div class="mb-5">
                                    <p>Kliknij na zdjęciu by wyświetlić więcej opcji</p>
                                    @foreach($gallery as $img)
                                        <a href="#" class=dropdown-toggle" role="button" id="image-options{{ $img['id'] }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ route('image.thumbnail', ['path' => $img['image'], 'width' => 150, 'height' => 150]) }}" alt="Zdjęcie">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="image-options{{ $img['id'] }}">
                                            @if($img['cover'] == 0)
                                                <li>
                                                    <form method="post" action="{{ route('gallery.cover.send', ['module' => 'pages', 'moduleId' => $id, 'id' => $img['id']]) }}" class="dropdown-item">
                                                        @csrf
                                                        <input type="submit" value="Ustaw jako zdjęcie główne" class="btn btn-link">
                                                    </form>
                                                </li>
                                            @endif
                                            <li>
                                                <form method="post" action="{{ route('gallery.delete.send', ['id' => $img['id']]) }}" class="dropdown-item">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="submit" value="Usuń zdjęcie" class="btn btn-link">
                                                </form>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            @else
                                <p>Nie dodano jeszcze żadnego zdjęcia</p>
                            @endif
                            <form method="post" action="{{ route('gallery.add.send', ['module' => 'pages', 'moduleId' => $id]) }}" enctype="multipart/form-data">
                                @csrf
                                <label>
                                    Plik graficzny
                                    <input type="file" name="image" required="required" class="@error('image') is-invalid @enderror">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
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
                            @if($page->constant == 1)
                                <p>Tej strony nie można usunąć</p>
                            @else
                                <form method="post" action="{{ route('admin.pages.delete.send', ['id' => $id]) }}">
                                    @method('delete')
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
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
