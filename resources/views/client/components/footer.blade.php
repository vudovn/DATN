<footer class="footer">
    <div class="footer-container container">
        <div class="footer-main row">
            <div class="footer-logo col-md-3 col-12">
                <a href="#"><img src="/logoTGNT-red.png" alt="Heilsa" /></a>
            </div>
            <div class="footer-section col-md-2 col-5">
                <h3>Danh mục</h3>
                <ul>
                    <li><a href="{{ route('client.home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('client.about.index') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('client.collection.index') }}">Bộ sưu tập</a></li>
                    <li><a href="{{ route('client.contact.index') }}">Liên hệ</a></li>
                </ul>
            </div>

            <div class="footer-section col-md-2 col-5">
                <h3>Loại sản phẩm</h3>
                <ul>
                    @foreach (getCategory('other')->take(4) as $item)
                        <li><a href="{{ route('client.category.index', $item->id) }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-section col-md-2 col-5">
                <h3>Loại phòng</h3>
                <ul>
                    @foreach (getCategory('room')->take(4) as $item)
                        <li><a href="{{ route('client.category.index', $item->id) }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-section col-md-3 col-6">
                <h3>Liên lạc</h3>
                <div class="get-in-touch">
                    <p>Câu hỏi hoặc phản hồi?</p>
                    <p>chúng tôi muốn nghe ý kiến ​​từ bạn <a href="{{ route('client.contact.index') }}">Liên hệ</a></p>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-left">
                <span>©2024 {{ getSetting()->site_name }}.</span>
                <a href="#">Điều khoản dịch vụ</a>
                <a href="#">Chính sách bảo mật</a>
            </div>
            <div class="social-icons">
                <a href="https://www.facebook.com/{{ getSetting()->site_social->facebook }}" class="social-icon">
                    <i style="color: #016bdf" class="fa-brands fa-facebook"></i>
                </a>
                <a href="https://www.youtube.com/{{ '@' . getSetting()->site_social->youtube }}"
                    class="social-icon yt">
                    <i style="color: #ff0033" class="fa-brands fa-youtube"></i>
                </a>
                <a href="https://www.instagram.com/{{ getSetting()->site_social->instagram }}" class="social-icon tw">
                    <i style="color: #f64a1f" class="fa-brands fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
<script src="https://kit.fontawesome.com/b8d3f92d8d.js" crossorigin="anonymous"></script>
