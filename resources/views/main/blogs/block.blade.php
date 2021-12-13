<section class="card">
    <a href="{{ $blog->url }}">
        <img src="{{ route('image.thumbnail', ['path' => $cover, 'width' => 320, 'height' => 240]) }}" alt="{{ $blog->title }}" class="card-img">
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ $blog->url }}">
                {{ $blog->title }}
            </a>
        </h4>
        <p class="card-text">
            {{ $blog->description }}
        </p>
        <strong class="card-price">
            {{ dateTimeFormat(strtotime($blog->created_at)) }}
        </strong>
        <div class="card-buttons">
            <a href="{{ $blog->url }}" class="btn btn-primary">
                {{ __('blog.button.more') }}
            </a>
        </div>
    </div>
</section>
