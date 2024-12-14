@php
    if ($variant->albums != '"0"') {
        $albums = array_map('trim', explode(',', trim($variant->albums, '[]"')));
    } else {
        $albums = json_decode($product->albums);
    }
@endphp

<div class="fotorama" data-nav="thumbs" data-width="100%" data-ratio="900/600" data-allowfullscreen="true">
    @if ($albums)
        @foreach ($albums as $album)
            <img class="img-preview-tgnt" src="{{ asset($album) }}" alt="{{ $product->name }}">
        @endforeach
    @endif
</div>
