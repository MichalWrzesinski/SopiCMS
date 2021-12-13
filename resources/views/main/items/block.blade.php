<section class="card">
    <a href="{{ $item->url }}">
        <img src="{{ route('image.thumbnail', ['path' => $cover, 'width' => 320, 'height' => 240]) }}" alt="{{ $item->title }}" class="card-img">
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ $item->url }}">
                {{ $item->title }}
            </a>
        </h4>
        <p class="card-text">
            {{ $item->description }}
        </p>
        <strong class="card-price">
            {{ priceFormat($item->price) }}
        </strong>
        <div class="card-buttons">
            @if(isset($mode) && $mode == 'edit')
                <a href="{{ route('user.item.edit', ['id' => $item['id']]) }}" class="btn btn-primary">
                    {{ __('items.button.manage') }}
                </a>
            @else
                <a href="{{ $item->url }}" class="btn btn-primary">
                    {{ __('items.button.more') }}
                </a>
            @endif
        </div>
    </div>
    @if($item->premium > Carbon\Carbon::now())
        <span class="position-absolute top-0 start-0">
            <span class="d-inline-block py-2 px-3 bg-danger text-light fw-bold small">
                {{ __('items.alert.premium') }}
            </span>
        </span>
    @endif
</section>
