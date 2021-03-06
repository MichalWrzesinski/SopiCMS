@extends('admin.layouts.layout')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('layout.header.admin') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.items.list') }}">{{ __('items.header.title') }}</a></li>
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

                            <form method="post" action="{{ route('admin.items.public.send', ['id' => $id]) }}">
                                @csrf
                                <label>
                                    {{ __('items.field.status') }}
                                    <select name="status">
                                        <option value="0"@if($item->status == 0) selected="selected"@endif>{{ config('sopicms.item.status.0') }}</option>
                                        <option value="1"@if($item->status == 1) selected="selected"@endif>{{ config('sopicms.item.status.1') }}</option>
                                    </select>
                                </label>
                                <label>
                                    {{ __('items.field.validityDate') }}
                                    <input type="text" name="validity" required="required" class="@error('validity') is-invalid @enderror" value="{{ old('validity', $item->validity) }}">
                                    @error('validity')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('items.field.promoteDate') }}
                                    <input type="text" name="premium" class="@error('premium') is-invalid @enderror" value="{{ old('premium', $item->premium) }}">
                                    @error('premium')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('items.button.save') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-2">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-2-container" aria-expanded="false" aria-controls="section-2-container">
                            {{ __('items.field.content') }}
                        </button>
                    </h2>
                    <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.items.edit.send', ['id' => $id]) }}">
                                @csrf

                                <div class="row">
                                    <div class="col-8">
                                        <label>
                                            {{ __('items.field.title') }}
                                            <input type="text" name="title" required="required" class="@error('title') is-invalid @enderror" value="{{ old('title', $item->title) }}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <label>
                                            {{ __('items.field.price') }}
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
                                            {{ __('items.field.category') }}
                                            <select name="category" required="required" class="@error('category') is-invalid @enderror">
                                                <option value="">{{ __('items.field.select') }}</option>
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
                                            {{ __('items.field.region') }}
                                            <select name="region" required="required" class="@error('category') is-invalid @enderror">
                                                <option value="">{{ __('items.field.select') }}</option>
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
                                            {{ __('items.field.city') }}
                                            <input type="text" name="city" required="required" class="@error('city') is-invalid @enderror" value="{{ old('city', $item->city) }}">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                                <label>
                                    {{ __('items.field.content') }}
                                    <textarea name="content" required="required">{{ old('content', $item->content) }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('items.button.save') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-3">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-3-container" aria-expanded="false" aria-controls="section-3-container">
                            {{ __('gallery.header.title') }}
                        </button>
                    </h2>
                    <div id="section-3-container" class="accordion-collapse collapse" aria-labelledby="section-3">
                        <section class="accordion-body p-4">
                            @if(isset($gallery) && is_array($gallery) && count($gallery) > 0)
                                <div class="mb-5">
                                    <p>{{ __('gallery.alert.info') }}</p>
                                    @foreach($gallery as $img)
                                        <a href="#" class=dropdown-toggle" role="button" id="image-options{{ $img['id'] }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ route('image.thumbnail', ['path' => $img['image'], 'width' => 150, 'height' => 150]) }}" alt="Img">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="image-options{{ $img['id'] }}">
                                            @if($img['cover'] == 0)
                                                <li>
                                                    <form method="post" action="{{ route('gallery.cover.send', ['module' => 'items', 'moduleId' => $id, 'id' => $img['id']]) }}" class="dropdown-item">
                                                        @csrf
                                                        <input type="submit" value="{{ __('gallery.button.cover') }}" class="btn btn-link">
                                                    </form>
                                                </li>
                                            @endif
                                            <li>
                                                <form method="post" action="{{ route('gallery.delete.send', ['id' => $img['id']]) }}" class="dropdown-item">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="submit" value="{{ __('gallery.button.delete') }}" class="btn btn-link">
                                                </form>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            @else
                                <p>{{ __('gallery.alert.notFound') }}</p>
                            @endif
                            <form method="post" action="{{ route('gallery.add.send', ['module' => 'items', 'moduleId' => $id]) }}" enctype="multipart/form-data">
                                @csrf
                                <label>
                                    {{ __('gallery.field.file') }}
                                    <input type="file" name="image" required="required" class="@error('image') is-invalid @enderror">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('gallery.button.submit') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-4">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-4-container" aria-expanded="false" aria-controls="section-4-container">
                            {{ __('items.header.delete') }}
                        </button>
                    </h2>
                    <div id="section-4-container" class="accordion-collapse collapse" aria-labelledby="section-4">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.items.delete.send', ['id' => $id]) }}">
                                @method('delete')
                                @csrf
                                <label>
                                    <input type="checkbox" name="delete" value="1" required="required" class="@error('delete') is-invalid @enderror">
                                    {{ __('items.field.delete') }}
                                </label>
                                @error('delete')
                                    <span class="invalid-feedback" role="alert">>{{ $message }}</span>
                                @enderror
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('items.button.delete') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
