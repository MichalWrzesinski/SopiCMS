@extends('admin.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Panel administracyjny</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.items.list') }}">{{ config('sopicms.item.name') }}</a></li>
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

                            <form method="post" action="{{ route('admin.items.public.send', ['id' => $id]) }}">
                                @csrf
                                <label>
                                    Status
                                    <select name="status">
                                        <option value="0"@if($item->status == 0) selected="selected"@endif>{{ config('sopicms.item.status.0') }}</option>
                                        <option value="1"@if($item->status == 1) selected="selected"@endif>{{ config('sopicms.item.status.1') }}</option>
                                    </select>
                                </label>
                                <label>
                                    Data publikacji
                                    <input type="text" name="validity" required="required" class="@error('validity') is-invalid @enderror" value="{{ old('validity', $item->validity) }}">
                                    @error('validity')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    Data promowania
                                    <input type="text" name="premium" class="@error('premium') is-invalid @enderror" value="{{ old('premium', $item->premium) }}">
                                    @error('premium')
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
                            Treść
                        </button>
                    </h2>
                    <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.items.edit.send', ['id' => $id]) }}">
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
                                            <input type="text" name="price" required="required" class="@error('price') is-invalid @enderror" value="{{ old('price', $item->price) }}">
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
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-3">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-3-container" aria-expanded="false" aria-controls="section-3-container">
                            Galeria zdjęć
                        </button>
                    </h2>
                    <div id="section-3-container" class="accordion-collapse collapse" aria-labelledby="section-3">
                        <section class="accordion-body p-4">
                            <div class="mb-5">
                                @if(count($item->gallery) > 0)
                                    <p>Kliknij na zdjęciu by wyświetlić więcej opcji</p>
                                    @foreach($item->gallery as $key => $img)
                                        <a href="#" class=dropdown-toggle" role="button" id="aaa{{ $key }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ route('image.thumbnail', ['path' => $img, 'width' => 150, 'height' => 150]) }}" alt="Zdjęcie">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="aaa{{ $key }}">
                                            @if($key > 0)
                                                <li>
                                                    <a href="{{ route('admin.items.gallery.cover.send', ['id' => $id, 'key' => $key]) }}" class="dropdown-item">
                                                        Ustaw jako zdjęcie główne
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('image.show', ['path' => $img]) }}" class="dropdown-item" target="_blank">
                                                    Pokaż zdjęcie
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.items.gallery.delete.send', ['id' => $id, 'key' => $key]) }}" class="dropdown-item">
                                                    Usuń zdjęcie
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                @else
                                    <p>Nie dodano jeszcze żadnego zdjęcia</p>
                                @endif
                            </div>
                            <form method="post" action="{{ route('admin.items.gallery.send', ['id' => $id]) }}" enctype="multipart/form-data">
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
                    <h2 class="accordion-header" id="section-4">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-4-container" aria-expanded="false" aria-controls="section-4-container">
                            Usuń rekord
                        </button>
                    </h2>
                    <div id="section-4-container" class="accordion-collapse collapse" aria-labelledby="section-4">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.items.delete.send', ['id' => $id]) }}">
                                @csrf
                                <label>
                                    <input type="checkbox" name="delete" value="1" required="required" class="@error('delete') is-invalid @enderror">
                                    Potwierdzam chęć usunięcia tego rekordu
                                </label>
                                @error('delete')
                                    <span class="invalid-feedback" role="alert">>{{ $message }}/span>
                                @enderror
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
