@if (!is_null($attributeCategory))
    @foreach ($attributeCategory as $item)
        <div class="attribute">
            <div class="mb-xxl-3 mb-2 attribute-item">
                <strong>{{ $item->name }}</strong> <span class="text-tgnt"></span><br>
                <div class="attribute-value">
                    @foreach ($item->attributes as $key => $attribute)
                        <button type="button" data-attributeId="{{ $attribute->id }}"
                            class="choose-attribute btn btn-sm btn-outline-secondary {{ $key == 0 ? 'active' : '' }}">{{ $attribute->value }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endif
<input type="hidden" name="product_id" value="{{ $product->id }}"> 
