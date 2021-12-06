@extends('main.layouts.layout')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Twoje konto</a></li>
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
                    @include('tools.alert')
                </section>
                <div class="row">
                    @foreach($list as $item)
                        <div class="col-xl-4 mb-4">
                            @include('main.items.block', ['mode' => 'edit', 'item' => $item, 'cover' => $gallery[$item->id]])
                        </div>
                    @endforeach
                </div>
                {{ $list->links() }}
            </div>
        </div>
    </div>
@endsection
