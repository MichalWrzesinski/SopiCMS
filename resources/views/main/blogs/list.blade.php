@extends('main.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="container">
        <section class="p-4 mb-4">
            <h1>{{ $title }}</h1>
        </section>
        <div class="row">
            @foreach($list as $blog)
                <div class="col-xl-4 mb-4">
                     @include('main.blogs.block', ['blog' => $blog, 'cover' => $gallery[$blog->id]])
                </div>
            @endforeach
        </div>
        {{ $list->links() }}
    </div>
@endsection
