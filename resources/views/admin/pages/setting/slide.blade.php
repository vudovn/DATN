@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <form action="{{ route('setting.sliderUpdate') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-header">
                        Thông tin chung
                    </div>
                    <div class="card-body">
                        <div class="text-end mb-3">
                            <button type="button" class="add-slide btn btn-success" data-bs-toggle="tooltip"
                                title="Thêm một bộ sưu tập mới">
                                <i class="ti ti-plus-circle me-2"></i> Thêm bộ sưu tập
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Bộ sưu tập</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="slide-list">
                                    @if ($slides->isEmpty())
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">Hiện tại chưa có bộ sưu tập
                                                nào.</td>
                                        </tr>
                                    @else
                                        @foreach ($slides as $slide)
                                            <tr class="slide-item">
                                                <td>
                                                    <select name="collection_id[{{ $slide->id }}]"
                                                        class="form-select collection-select select2">
                                                        <option value="">Chọn bộ sưu tập</option>
                                                        @foreach ($collections as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if ($slide->collection_id == $item->id) selected @endif>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="remove-slide btn btn-outline-danger"
                                                        onclick="confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <i class="ti ti-trash me-1"></i> Xóa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-3">
                <x-save_back :model="'setting'" />
                {{-- <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.active')" :value="$user->publish ?? ''" /> --}}
            </div>

        </div>
        <input type="hidden" name="page" value="{{ request()->get('page', 1) }}" />
    </form>
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
    <script>
        let collections = @json($collections ?? []);
    </script>
@endsection
