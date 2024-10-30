@if (isset($users) && count($users))
    @foreach ($users as $user)
        <tr class="animate__animated animate__fadeIn">
            <td class="">
                <div class="form-check">
                    <input class="form-check-input input-primary input-checkbox checkbox-item alotest"
                        type="checkbox" id="customCheckbox{{ $user->id }}"
                        value="{{ $user->id }}">
                    <label class="form-check-label"
                        for="ustomCheckbox{{ $user->id }}"></label>
                </div>
            </td>
            <td>{{ $user->id }}</td>
            <td>
                <a href="{{ $user->avatar }}" data-fancybox="gallery">
                    <img loading="lazy" width="50" class="rounded" src="{{ $user->avatar }}"
                        alt="{{ $user->name }}">
                </a>
            </td>
            <td>
                <div class="row-name text-primary">{{ $user->name }}</div>
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ changeDateFormat($user->created_at) }}</td>
            <td class="text-center">
                {{ $user->getRoleNames()->isempty() ? 'Khách' : $user->getRoleNames()->join(', ')}}
            </td>
            <td class="text-center">
                @if ($user->id != auth()->id())
                    <x-switchvip :value="$user" :model="ucfirst($config['model'])" />
                @else
                    <span class="badge badge-success">-</span>
                @endif
            </td>
            <td class="text-center table-actions">
                <ul class="list-inline me-auto mb-0">
                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Chỉnh sửa">
                        <a href="{{ route('user.edit', $user->id) }}"
                            class="avtar avtar-xs btn-link-success btn-pc-default">
                            <i class="ti ti-edit-circle f-18"></i>
                        </a>
                    </li>
                @if ($user->id != auth()->id())
                    <x-delete :id="$user->id" :model="ucfirst($config['model'])" />
                @endif
                </ul>
            </td>
        </tr>
    @endforeach
    <tr class="animate__animated animate__fadeInDown animate__faster">
        <td colspan="100">
            {!! $users->links('pagination::bootstrap-4') !!}
        </td>
    </tr>
    @else
<tr>
    <td colspan="100" class="text-center">Không có dữ liệu</td>
</tr>
@endif
