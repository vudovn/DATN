@props(['id', 'model', 'deleteAxis'])
<a data-id="{{ $id }}" data-model="{{ $model }}" data-axis="{{$deleteAxis ?? 'row'}}" id="delete_tgnt" class="btn btn-sm btn-icon btn-danger" href="#" >
    <svg class="icon  svg-icon-ti-ti-trash" data-bs-toggle="tooltip" data-bs-title="Delete" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M4 7l16 0"></path>
        <path d="M10 11l0 6"></path>
        <path d="M14 11l0 6"></path>
        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
      </svg>
</a>