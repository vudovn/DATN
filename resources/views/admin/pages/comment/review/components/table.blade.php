@if (isset($reviews) && count($reviews))
    @foreach ($reviews as $key => $review)
        <tr class="animate__animated animate__fadeInDown animate__faster">
            <td class="">
                <div class="form-check">
                    <input class="form-check-input input-primary input-checkbox checkbox-item" type="checkbox"
                        id="customCheckbox{{ $review->id }}" value="{{ $review->id }}">
                    <label class="form-check-label" for="ustomCheckbox{{ $review->id }}"></label>
                </div>
            </td>
            <td>{{ $key+1 }}</td>
            <td>
                <a href="{{ $review->user->avatar }}" data-fancybox="gallery">
                    <img loading="lazy" width="50" class="rounded" src="{{ $review->user->avatar }}" alt="{{ $review->user->name }}">
                </a>

            </td>

            <td>
            {{$review->user->name}}
            </td>

            <td>
                <span class="row-name">{{ $review->content }}</span>
            </td>
            <td>
                <div class="review-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->rating)
                            <span class="star filled text-warning"><i class="fas fa-star"></i></span>
                        @else
                            <span class="star text-warning"><i class="far fa-star"></i></span>
                        @endif
                    @endfor
                </div>
            </td>
            <td>{{ $review->product->name }}</td>
            <td>{{ changeDateFormat($review->created_at) }}</td>
            <td class="text-center table-actions">
                <ul class="list-inline me-auto mb-0">
                    <x-delete :id="$review->id" :model="ucfirst($config['model'])"/>
                </ul>
            </td>
        </tr>
    @endforeach
@else
<tr>
    <td colspan="9" class="text-center">Không có dữ liệu</td>
</tr>
@endif
