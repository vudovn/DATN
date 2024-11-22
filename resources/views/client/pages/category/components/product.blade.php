<div class="row animate__animated animate__fadeIn listProduct mb-4">
    @if ($products->count() > 0)
        @foreach ($products as $item)
            <x-productCard :data="$item" />
        @endforeach
    @else
        <div class="col-12">
            <div class="text-center">
                Không có sản phẩm nào!
            </div>
        </div>
    @endif
</div>
<div class="pagination_tgnt d-flex justify-content-center">
    {!! $products->links('pagination::bootstrap-4') !!}
</div>

<style>

</style>
