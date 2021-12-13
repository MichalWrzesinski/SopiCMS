@extends('admin.layouts.layout')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('layout.header.admin') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.items.list') }}">{{ __('items.header.title') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.list') }}">{{ __('categories.header.title') }}</a></li>
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

                            <form method="post" action="{{ route('admin.categories.edit.send', ['id' => $id]) }}">
                                @csrf
                                <label>
                                    {{ __('categories.field.name') }}
                                    <input type="text" name="name" required="required" class="@error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label>
                                    {{ __('categories.field.tree') }}
                                    <select name="parent">
                                        <option value="0">{{ __('categories.field.head') }}</option>
                                        @if(isset($list[0]) && is_array($list[0]))
                                            @foreach($list[0] as $cat)
                                                <option value="{{ $cat['id'] }}"@if($category->parent_id == $cat['id']) selected="selected"@endif>{{ $cat['name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('layout.button.save') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

                <div class="accordion-item mb-4">
                    <h2 class="accordion-header" id="section-2">
                        <button class="accordion-button collapsed text-black" type="button" data-bs-toggle="collapse" data-bs-target="#section-2-container" aria-expanded="false" aria-controls="section-2-container">
                            {{ __('categories.header.delete') }}
                        </button>
                    </h2>
                    <div id="section-2-container" class="accordion-collapse collapse" aria-labelledby="section-2">
                        <section class="accordion-body p-4">
                            <form method="post" action="{{ route('admin.categories.delete.send', ['id' => $id]) }}">
                                @method('delete')
                                @csrf
                                <label>
                                    <input type="checkbox" name="delete" value="1" required="required" class="@error('delete') is-invalid @enderror">
                                    {{ __('categories.field.delete') }}
                                </label>
                                <div class="mt-4">
                                    <input type="submit" value="{{ __('layout.button.delete') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
