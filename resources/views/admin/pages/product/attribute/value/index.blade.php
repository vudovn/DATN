@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="row">
        <div class="col-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thêm biến thể cho thuộc tính <strong>{{ $attributes->name }}</strong></h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.attributeValue.store') }}" method="post">
                        @csrf
                        <div class="form-guop">
                            <input type="hidden" name="attribute_id" value="{{ $attributes->id }}">
                            <x-input :label="'Tên biến thể'" :name="'value'" :require="true" />
                        </div>
                        <div class="form-guop mt-3 d-flex justify-content-between">
                            <a href="{{ route('product.attribute.index') }}" class="btn btn-danger">Quay lại</a>
                            <x-button :label="'Lưu'" :class="'btn-success'" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-8">
            <div class="card">
                <div class="card-header pb-0">
                    <x-filter
                     :options="[
                        'actions' => generateSelect('Hành động', __('general.actions')),
                        'publish' => generateSelect('Trạng thái', __('general.publish')),
                    ]" />
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-checkbox" type="checkbox" id="checkAll">
                                        <label for="checkAll" class="custom-control-label"></label>
                                    </div>
                                </th>
                                <th>Tên</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($attributes->attribute_values) && count($attributes->attribute_values))
                                @foreach ($attributes->attribute_values as $attribute)
                                    <tr>
                                        <td class="">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input input-checkbox checkbox-item"
                                                    type="checkbox" value="{{ $attribute->id }}"
                                                    id="customCheckbox{{ $attribute->id }}">
                                                <label for="customCheckbox{{ $attribute->id }}"
                                                    class="custom-control-label"></label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $attribute->value }}
                                        </td>
                                        <td class="text-center">
                                            {{-- <a href="{{ route('product.attribute.edit', ['id' => $attribute->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-pen"></i></a> --}}
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <x-delete :id="$attribute->id" />
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Không có dữ liệu</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{-- {{ $attributes->links('pagination::bootstrap-4') }} --}}
                </div>
            </div>
        </div>
    </div>

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('product.attributeValue.update') }}" method="post" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-guop">
                    <x-input :label="'Tên biến thể'" :name="'value'" :require="true" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
          <button type="submit" name="send" class="btn btn-success">Lưu</button>
            </div>
        </form>

    </div>
  </div>

@endsection
