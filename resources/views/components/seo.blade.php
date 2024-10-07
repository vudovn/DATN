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

            <div class="row justify-content-center">
                <div class="card col-lg-6 col-md-8">
                    <div class="card-body">
                        <div class="box_seo">
                            <div class="top_box_seo d-flex algin-items-center">
                                <div class="top_box_seo_icon d-flex align-items-center">
                                    <img src="https://static.cdninstagram.com/rsrc.php/v3/yI/r/VsNE-OHk_8a.png"
                                        alt="">
                                </div>
                                <div class="top_box_seo_content">
                                    <span>Thế Giới Nội Thất</span>
                                    <small>{{ url('/') }}/<span class="value_seo_slug">bo-ban-an-go-4-ghe-kai-dep-moc-mac</span>
                                        &nbsp; <i class="fa-regular fa-ellipsis-vertical"></i></small>
                                </div>
                            </div>
                            <div class="bottom_box_seo">
                                <div>
                                    <span class="value_seo_title">Bộ bàn ăn gỗ 4 ghế KAI đẹp mộc mạc giá rẻ nhất tại Thế Giới Nội Thất</span>
                                </div>
                                <div>
                                    <span class="value_seo_description">Bộ bàn ăn gỗ 4 ghế Kai đẹp tinh tế với những thông số vàng nâng niu trải nghiệm của khách hàng cùng thiết kế mãn nhãn. Lựa chọn số 1 cho bạn ...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="meta_title">
                    <span>Tiêu đề SEO <small>(Tối đa 50 ký tự)</small></span>
                    <span> - Hiện tại: <span class="count_meta_title">0</span> ký tự</span>
                </label>
                <input value="{{ old('meta_title', $value_meta_title) ?? '' }}" type="text" class="form-control"
                    id="meta_title" name="meta_title">
            </div>
            <div class="form-group">
                <label for="meta_keyword">
                    <span>Từ khóa SEO <small>(Tối đa 4 thẻ)</small></span>
                </label>
                <input value="thế giới nội thất,{{ old('meta_keyword', $value_meta_title) ?? '' }}" type="text" class="tagify_tgnt form-control"
                    id="meta_keyword" name="meta_keyword">
            </div>
            <div class="form-group">
                <label for="meta_description">
                    <span>Mô tả SEO <small>(Tối đa 160 ký tự)</small></span>
                    <span> - Hiện tại: <span class="count_meta_description">0</span> ký tự</span>
                </label>
                <textarea rows="3" class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $value_meta_description) ?? '' }}</textarea>
            </div>
        </div>
    </div>
</div>
