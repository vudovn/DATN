@if (isset($products) && count($products))
    <div class="row mt-3 animate__animated animate__fadeIn">
        @foreach ($products as $key => $product)
            <div class="col-md-2 p-1">
                <label for="checkInput{{ $product->id }}" style="cursor: pointer;">
                    <input type="checkbox" id="checkInput{{ $product->id }}" class="checkInput hidden"
                        data-id="{{ $product->id }}">
                    <div class="card" id="product-item{{ $product->id }}">
                        <img class="img card-img-top p-1" height="100" src="{{ $product->thumbnail }}"
                            alt="Card image cap">
                        <div class="card-body p-2">
                            <span class="card-title text-limit text-primary"
                                style="font-size: 12px">{{ $product->name }}</span>
                            <p class="card-text" style="font-size: 10px">{{ number_format($product->price) }} đ</p>
                            {{-- <p class="card-text" style="font-size: 10px">{{ $product->publish }}</p> --}}
                        </div>
                    </div>
                </label>

            </div>
        @endforeach
        {!! $products->links('pagination::bootstrap-4') !!}
    </div>
@else
    <tr>
        <td colspan="100" class="text-center">Không có dữ liệu</td>
    </tr>
@endif



<style>
    .text-limit {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card {
        transition: background-color 0.3s ease;
    }
</style>
