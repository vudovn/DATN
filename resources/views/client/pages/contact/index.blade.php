@extends('client.layout')

@section('content')
    <section>
        <div class="contact container">
            <div class="row all">
                <div class="content-left col-6">
                    <div class="layout mt-5 mb-5 bg-light">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d958.5093375031878!2d108.15358126955884!3d16.063551499038457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142192f508c3d63%3A0xce85820a33506aad!2zNzcgxJAuIFBo4bqhbSBOaMawIFjGsMahbmcsIEhvw6AgS2jDoW5oIE5hbSwgTGnDqm4gQ2hp4buDdSwgxJDDoCBO4bq1bmcgNTUwMDAwLCBWaWV0bmFt!5e0!3m2!1sfr!2s!4v1726993541791!5m2!1sfr!2s"
                            height="500" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="form-container content-right col-6">
                    <div class="content-right">
                        <h2>Liên hệ với chúng tôi hôm nay</h2>
                        <p>Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn với mọi thắc mắc. Hãy liên hệ ngay để nhận được
                            những
                            tư vấn tốt nhất từ đội ngũ chuyên gia của chúng tôi!</p>
                        <form action="{{ route('client.contact.send') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="form6Example1">Họ tên</label>
                                        <input type="text" name="name" id="form6Example1" class="form-control custom-form-control"
                                            placeholder="Họ tên" />
                                            @error('name')
                                                <small class="error text-danger">*{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="form6Example2">Email</label>
                                        <input type="text" name="email" id="form6Example2" class="form-control custom-form-control"
                                            placeholder="Email" />
                                            @error('email')
                                                <small class="error text-danger">*{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="form6Example3">Công ty</label>
                                        <input type="text" name="company" id="form6Example3" class="form-control custom-form-control"
                                            placeholder="Công ty" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label" for="form6Example4">Điện thoại</label>
                                        <input type="text" name="phone" id="form6Example4" class="form-control custom-form-control"
                                            placeholder="Điện thoại" />
                                            @error('phone')
                                                <small class="error text-danger">*{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form6Example5">Để lại lời nhắn</label>
                                <textarea class="form-control" id="form6Example5" name="message" rows="4" placeholder="Nhập lời nhắn"></textarea>
                                @error('message')
                                    <small class="error text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-tgnt">Gửi lời nhắn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
