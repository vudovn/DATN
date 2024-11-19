@php
    if ($variant->albums != '[]') {
        $albums = array_map(function ($url) {
            return trim($url, '"');
        }, explode(',', $variant->albums));
    } else {
        $albums = json_decode($product->albums);
    }
@endphp

<div class="fotorama" data-nav="thumbs" data-width="100%" data-ratio="900/600" data-allowfullscreen="true">
    @if ($albums)
        @foreach ($albums as $album)
            <img class="img-preview-tgnt" src="{{ $album }}" alt="{{ $product->name }}">
        @endforeach
    @endif
</div>
