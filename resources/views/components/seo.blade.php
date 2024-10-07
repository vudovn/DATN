@props(['value_meta_title', 'value_meta_description', 'value_meta_keywords'])
<div class="col-12">
    <div class="card">
        <div class="card-header bg-warning text-white">
            Cấu hình SEO
            <div class="card-tools">
                <button type="button" class="btn btn-warning btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="meta_title">Tiêu đề SEO</label>
                <input value="{{ old('meta_title', $value_meta_title) ?? '' }}" type="text" class="form-control"
                    id="meta_title" name="meta_title">
            </div>
            <div class="form-group">
                <label for="meta_description ">
                    <div class="d-flex justify-conten-between">
                        <div>Mô tả SEO (Tối đa 200 ký tự)</div>
                        <div class="count_meta_description text-end">0</div>
                    </div>
                </label>
                <textarea type="text" class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $value_meta_description) ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>
