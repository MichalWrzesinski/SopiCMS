<section class="item">
    <a href="{{ $item->url }}">
        <img src="{{ route('image.thumbnail', ['path' => $cover, 'width' => 320, 'height' => 240]) }}" alt="" class="img-fluid">
    </a>
    <div class="p-4">
        <h4><a href="{{ $item->url }}">{{ $item->title }}</a></h4>
        <p>{{ $item->description }}</p>
        <strong class="item-price">{{ priceFormat($item->price) }}</strong>
        <div class="item-buttons">
            @if(isset($mode) && $mode == 'edit')
                <a href="{{ route('user.item.edit', ['id' => $item['id']]) }}" class="btn btn-primary">Zarządzaj</a>
            @else
                <a href="{{ $item->url }}" class="btn btn-primary">Sprawdź ofertę</a>
            @endif
        </div>
    </div>
    @if($item->premium > Carbon\Carbon::now())
        <span class="position-absolute top-0 start-0">
            <span class="d-inline-block py-2 px-3 bg-danger text-light fw-bold small">Premium</span>
        </span>
    @endif
</section>
