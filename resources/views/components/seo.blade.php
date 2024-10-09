@props(['value_meta_title', 'value_meta_description', 'value_meta_keywords'])

    <div class="card">
        <div class="card-header bg-primary text-white">
            Cấu hình SEO
            <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <div class="box_seo">
                            <div class="top_box_seo d-flex algin-items-center">
                                <div class="top_box_seo_icon d-flex align-items-center">
                                    <img src="https://static.cdninstagram.com/rsrc.php/v3/yI/r/VsNE-OHk_8a.png"
                                        alt="">
                                </div>
                                <div class="top_box_seo_content">
                                    <span>Thế Giới Nội Thất</span>
                                    <small>{{ url('/') }}/san-pham/<span class="value_seo_slug">bo-ban-an-go-4-ghe-kai-dep-moc-mac</span>
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
                <label for="meta_title" class="d-flex justify-content-between">
                    <div>Tiêu đề SEO</div>
                    <small> (<span class="count_meta_title">0</span>/60)</small>
                </label>
                <input value="{{ old('meta_title', $value_meta_title) ?? '' }}" type="text" class="form-control"
                    id="meta_title" name="meta_title">
            </div>
            <div class="form-group">
                <label for="meta_description" class="d-flex justify-content-between">
                    <div>Mô tả SEO</div>
                    <small> (<span class="count_meta_description">0</span>/160)</small>
                </label>
                <textarea rows="3" class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $value_meta_description) ?? '' }}</textarea>
            </div>
        </div>
    </div>

