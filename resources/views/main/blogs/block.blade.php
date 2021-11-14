<section class="item">
    <a href="{{ $blog->url }}">
        <img src="{{ route('image.thumbnail', ['path' => $cover, 'width' => 320, 'height' => 240]) }}" alt="" class="img-fluid">
    </a>
    <div class="p-4">
        <h4><a href="{{ $blog->url }}">{{ $blog->title }}</a></h4>
        <p>{{ $blog->description }}</p>
        <strong class="item-price">{{ dateTimeFormat(strtotime($blog->created_at)) }}</strong>
        <div class="item-buttons">
            <a href="{{ $blog->url }}" class="btn btn-primary">Czytaj całość</a>
        </div>
    </div>
</section>
