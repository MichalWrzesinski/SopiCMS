@extends('main.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Twoje konto</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.item.list') }}">{{ config('sopicms.item.userList') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-sm-12">
                @include('main.layouts.left')
            </div>
            <div class="col-xl-9 col-sm-12">
                <section class="p-4 mb-4">
                    <h1>{{ $title }}</h1>
                    @include('main.layouts.alert')

                    <form method="post" action="{{ route('user.item.edit.send', ['id' => $id]) }}">
                        @csrf

                        <div class="row">
                            <div class="col-8">
                                <label>
                                    Tytuł
                                    <input type="text" name="title" required="required" class="@error('title') is-invalid @enderror" value="{{ old('title', $item->title) }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col-4">
                                <label>
                                    Cena
                                    <input type="text" name="price" required="required" class="@error('category') is-invalid @enderror" value="{{ old('price', $item->price) }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>
                                    Kategoria
                                    <select name="category" required="required" class="@error('category') is-invalid @enderror">
                                        <option value="">Wybierz</option>
                                        @if(isset($list[0]) && is_array($list[0]))
                                            @foreach($list[0] as $cat)
                                                @if(isset($list[$cat['id']]) && is_array($list[$cat['id']]))
                                                    <optgroup label="{{ $cat['name'] }}">
                                                        @foreach($list[$cat['id']] as $sub)
                                                            <option value="{{ $sub['id'] }}"@if($item->category_id == $sub['id']) selected="selected"@endif>{{ $sub['name'] }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <option value="{{ $cat['id'] }}"@if($item->category_id == $cat['id']) selected="selected"@endif>{{ $cat['name'] }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col-4">
                                <label>
                                    Region
                                    <select name="region" required="required" class="@error('category') is-invalid @enderror">
                                        <option value="">Wybierz</option>
                                        @if(is_array(config('sopicms.region')))
                                            @foreach(config('sopicms.region') as $key => $name)
                                                <option value="{{ $key }}"@if($item->region == $key) selected="selected"@endif>{{ $name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('region')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="col-4">
                                <label>
                                    Miejscowość
                                    <input type="text" name="city" required="required" class="@error('city') is-invalid @enderror" value="{{ old('city', $item->city) }}">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <label>
                            Treść
                            <textarea name="content" required="required">{{ old('content', $item->content) }}</textarea>
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
                    <h2 class="mb-0">Galeria zdjęć</h2>
                    <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-2" role="button" aria-expanded="false" aria-controls="collapse-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                        </svg>
                    </a>
                    <div id="collapse-2" class="collapse mt-4">
                        @if(isset($item->gallery) && is_array($item->gallery) && count($item->gallery) > 0)
                            <div class="mb-5">
                                <p>Kliknij na zdjęciu by wyświetlić więcej opcji</p>
                                @foreach($item->gallery as $key => $img)
                                    <a href="#" class=dropdown-toggle" role="button" id="aaa{{ $key }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ route('image.thumbnail', ['path' => $img, 'width' => 150, 'height' => 150]) }}" alt="Zdjęcie">
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="aaa{{ $key }}">
                                        @if($key > 0)<li><a href="{{ route('user.item.gallery.cover.send', ['id' => $id, 'key' => $key]) }}" class="dropdown-item">Ustaw jako zdjęcie główne</a></li>@endif
                                        <li><a href="{{ route('image.show', ['path' => $img]) }}" class="dropdown-item" target="_blank">Pokaż zdjęcie</a></li>
                                        <li><a href="{{ route('user.item.gallery.delete.send', ['id' => $id, 'key' => $key]) }}" class="dropdown-item">Usuń zdjęcie</a></li>
                                    </ul>
                                @endforeach
                            </div>
                        @else
                            <p>Nie dodano jeszcze żadnego zdjęcia</p>
                        @endif
                        <form method="post" action="{{ route('user.item.gallery.send', ['id' => $id]) }}" enctype="multipart/form-data">
                            @csrf
                            <label>
                                Plik graficzny
                                <input type="file" name="file" required="required" class="@error('file') is-invalid @enderror">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">>{{ $message }}/span>
                                @enderror
                            </label>
                            <div class="mt-4">
                                <input type="submit" value="Dodaj zdjęcie" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </section>
                <section class="p-4 mb-4">
                    <h2 class="mb-0">{{ config('sopicms.item.delete') }}</h2>
                    <a class="position-absolute top-0 end-0 p-4" data-bs-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                        </svg>
                    </a>
                    <div id="collapse-1" class="collapse mt-4">
                        <form method="post" action="{{ route('user.item.delete.send', ['id' => $id]) }}">
                            @csrf
                            <label>
                                <input type="checkbox" name="delete" value="1" required="required" class="@error('delete') is-invalid @enderror">
                                Potwierdzam chęć usunięcia tego ogłoszenia
                                @error('delete')
                                    <span class="invalid-feedback" role="alert">>{{ $message }}/span>
                                @enderror
                            </label>
                            <div class="mt-4">
                                <input type="submit" value="Usuń" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
