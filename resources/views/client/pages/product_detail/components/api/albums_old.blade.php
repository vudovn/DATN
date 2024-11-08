@php
    if ($variant->albums != '[]') {
        $albums = array_map(function ($url) {
            return trim($url, '"');
        }, explode(',', $variant->albums));
    } else {
        $albums = json_decode($product->albums);
    }
@endphp

<div class="row">
    <div class="col-md-12 text-center overflow-hidden rounded">
        <div class="bg-secondary overflow-hidden rounded">
            @if ($albums)
                <a href="{{ $albums[0] }}" class="img_preview" data-fancybox="gallery">
                    <img id="mainImage" src="{{ $albums[0] }}" class="product-image img-fluid rounded"
                        alt="Main Product Image">
                </a>
            @endif
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12 text-center thumbnail-images">
        @if ($albums)
            @foreach ($albums as $key => $album)
                <img src="{{ $album }}" alt="{{ $variant->name }}"
                    class="img-thumbnail {{ $key == 0 ? 'active' : '' }}" data-image="{{ $album }}"
                    alt="{{ $variant->name }}">
            @endforeach
        @endif
    </div>
</div>
