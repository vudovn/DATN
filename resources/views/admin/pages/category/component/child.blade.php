<tr>
    <td> 
        {{-- <i class="bi bi-arrow-return-right"></i> --}}
        
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input input-checkbox checkbox-item" type="checkbox"
                value="{{ $child->id }}" id="customCheckbox{{ $child->id }}">
            <label for="customCheckbox{{ $child->id }}" class="custom-control-label"></label>
        </div>
    </td>
    <td>{{ $child->id }}</td>
    <td>
        <a data-fancybox="gallery" href="{{ $child->thumbnail }}">
            <img loading="lazy" width="80" class="rounded" src="{{ $child->thumbnail }}" alt="{{ $child->name }}">
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
    <td class="text-center js-switch-{{ $child->id }}">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input js-switch status"
                id="customSwitch{{ $child->id }}" data-field="publish" data-value="{{ $child->publish }}"
                data-model="{{ ucfirst($config['model']) }}" data-id="{{ $child->id }}"
                {{ $child->publish === 1 ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch{{ $child->id }}"></label>
        </div>
    </td>
    <td class="text-center table-actions">
        <a href="{{ route('category.edit', ['id' => $child->id]) }}" class="btn btn-sm btn-icon btn-primary">
            <svg class="icon  svg-icon-ti-ti-edit" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                <path d="M16 5l3 3"></path>
            </svg>
        </a>
            <x-delete :id="$child->id" :model="ucfirst($config['model'])"/>       
    </td>
</tr>
@foreach($child->children as $child)   
    @include('admin.pages.category.component.child', ['char' => $char .' |-- '])                              
@endforeach    