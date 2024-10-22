<tr>
    <td> 
        <div class="form-check">
            <input class="form-check-input input-primary input-checkbox checkbox-item"
                type="checkbox" id="customCheckbox{{ $category->id }}"
                value="{{ $category->id }}">
            <label class="form-check-label"
                for="ustomCheckbox{{ $category->id }}"></label>
        </div>
    </td>
    <td>{{ $child->id }}</td>
    <td>
        <a data-fancybox="gallery" href="{{ $child->thumbnail }}">
            <img loading="lazy" width="50" class="rounded" src="{{ $child->thumbnail }}" alt="{{ $child->name }}">
        </a>
    </td>    
    <td>
        <span class="row-name">{{ $char }}{{ $child->name }}</span>
    </td>          
    @if($category->is_room == 2)
        <td>Phòng</td>
    @else
        <td>Danh mục khác</td>
    @endif                        
    <td>{{ changeDateFormat($child->created_at) }}</td>                  
    <td class="text-center">
        <x-switchvip :value="$category" :model="ucfirst($config['model'])" />
    </td>
    <td class="text-center table-actions">
        <ul class="list-inline me-auto mb-0">
            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                title="Chỉnh sửa">
                <a href="{{ route('category.edit', ['id' => $category->id, 'page' => request()->get('page', 1)]) }}"
                    class="avtar avtar-xs btn-link-success btn-pc-default">
                    <i class="ti ti-edit-circle f-18"></i>
                </a>
            </li>
            <x-delete :id="$child->id" :model="ucfirst($config['model'])"/>     
        </ul>  
    </td>
</tr>
@foreach($child->children as $child)   
    @include('admin.pages.category.component.child', ['char' => $char .' |-- '])                              
@endforeach    