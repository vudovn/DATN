@if (isset($users) && count($users))
    @foreach ($users as $user)
        @if (!$user->hasRole(['customer']))
            @continue
        @endif
        <tr class="animate__animated animate__fadeInDown animate__faster">
            <td class="">
                @if ($user->id != auth()->id())
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input input-checkbox checkbox-item" type="checkbox"
                            value="{{ $user->id }}" id="customCheckbox{{ $user->id }}">
                        <label for="customCheckbox{{ $user->id }}" class="custom-control-label"></label>
                    </div>
                @endif
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
                {{ $user->getRoleNames()->join(', ') }}
            </td>
            <td class="text-center">
                @if ($user->id != auth()->id())
                    <x-switchvip :value="$user" :model="ucfirst($config['model'])" />
                @else
                    <span class="badge badge-primary">-</span>
                @endif
            </td>
            <td class="text-center table-actions">
                <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-icon btn-primary">
                    <svg class="icon  svg-icon-ti-ti-edit" data-bs-toggle="tooltip" data-bs-title="Edit"
                        xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                        </path>
                        <path d="M16 5l3 3"></path>
                    </svg>
                </a>
                @if ($user->id != auth()->id())
                    <x-delete :id="$user->id" :model="ucfirst($config['model'])" />
                @endif
            </td>
        </tr>
    @endforeach
    <tr >
        <td colspan="100">
            {!! $users->links('pagination::bootstrap-4') !!}
        </td>
    </tr>
    {{-- @else
<tr>
    <td colspan="100" class="text-center">Không có dữ liệu</td>
</tr> --}}
@endif
