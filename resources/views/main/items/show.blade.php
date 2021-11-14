@extends('main.layouts.default')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ config('sopicms.siteName') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('item.list') }}">{{ config('sopicms.item.name') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-sm-12 mb-4">
                @if(!empty($gallery) && is_array($gallery) && count($gallery) > 0)
                    <div class="mb-4">
                        @if(isset($gallery[0]))
                            <a href="{{ route('image.show', ['path' => $gallery[0]['image']]) }}" data-lightbox="gallery">
                                <img src="{{ route('image.thumbnail', ['path' => $gallery[0]['image'], 'width' => 480, 'height' => 320]) }}" alt="{{ $item->title }}" class="img-fluid">
                            </a>
                        @endif
                        @if(isset($gallery[1]))
                            <div class="row">
                                @foreach($gallery as $img)
                                    @if(!$loop->first)
                                        <div class="col-3 mt-4">
                                            <a href="{{ route('image.show', ['path' => $img['image']]) }}" data-lightbox="gallery">
                                                <img src="{{ route('image.thumbnail', ['path' => $img['image'], 'width' => 150, 'height' => 150]) }}" alt="{{ $item->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
                @if(config('settings.ads.block4'))
                    <div id="block-4" class="mb-4">
                        {!! config('settings.ads.block4') !!}
                    </div>
                @endif
            </div>
            <div class="col-xl-6 col-sm-12">
                <section class="p-4 mb-4">
                    <h1>{{ $item->title }}</h1>
                    <ul class="list">
                        <li>Cena: <strong>{{ priceFormat($item->price) }}</strong></li>
                        <li>Kategoria: <strong>{{ $item->category_dir }}</strong></li>
                        @if($item->region <> '')<li>Województwo: <strong>{{config('sopicms.region.'.$item->region) }}</strong></li>@endif
                        @if($item->city <> '')<li>Miejscowość: <strong>{{ $item->city }}</strong></li>@endif
                        @if($item->user <> '')<li>Sprzedający: <strong><a href="{{ route('item.list', ['search' => config('sopicms.opd.user').'/'.$item->user_id]) }}">{{ $item->user }}</a></strong></li>@endif
                        @if($item->email <> '')<li>E-mail: <strong><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></strong></li>@endif
                        @if($item->phone <> '')<li>Telefon: <strong>{{ $item->phone }}</strong></li>@endif
                    </ul>
                </section>
                <section class="p-4 mb-4">
                    <h3>Szczegóły oferty</h3>
                    <p>{{ $item->content }}</p>
                </section>
            </div>
        </div>
    </div>

@endsection
