@extends('admin.pages.account.index')
@section('information')
    <form method="post" action="{{ route('setting.account.update', ['type' => 'information']) }}">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                Thông tin chung
            </div>
            <div class="row">
                <div class="card-body col-xl-4">
                    <x-thumbnail :label="'Ảnh đại diện'" :name="'avatar'" :value="$user->avatar ?? '/uploads/system/no_img.jpg'" />
                </div>
                <div class="card-body col-xl-8">
                    <div class="col-lg-12 mb-4">
                        <label for="">Họ tên</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="col-lg-12 mb-4">
                        <label for="">Email</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="text" class="form-control btn btn-link text-start w-75"
                                value="{{ str_repeat('*', strlen(explode('@', $user->email)[0])) . '@' . explode('@', $user->email)[1] }}"
                                disabled>
                            <input type="text" class="form-control hidden" name="email" value="{{ $user->email }}">
                            <button type="button" href="#" class="btn btn-link" data-bs-toggle="modal"
                                data-bs-target="#changeEmail">Chỉnh sửa</button>
                        </div>

                    </div>
                    <div class="col-lg-12 mb-4">
                        <label for="">Số điện thoại</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="text" class="form-control btn btn-link text-start w-75"
                                value="{{ str_repeat('*', strlen($user->phone) - 2) . substr($user->phone, -2) }}"
                                id="masked-phone" disabled>
                            <input type="text" class="form-control w-75 hidden" name="phone"
                                value="{{ $user->phone }}" id="real-phone">
                            <button type="button" class="btn btn-link mt-2" id="change-button">Chỉnh sửa</button>
                        </div>
                    </div>
                    <div class="text-end my-4" style="gap: 5%">
                        <button type="submit" name="send" value="send"
                            class="btn btn-primary d-inline-flex justify-content-center" style="flex: 1">
                            <i data-feather="check-circle" class="me-1"></i>
                            Lưu
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @php
            $roleName = $user->roles->pluck('name')->first();
        @endphp
        <input type="hidden" name="roles[]" value="{{ $roleName }}">
        <script>
            $(document).on('click', '#change-button', function() {
                $('#masked-phone, #real-phone').toggleClass('hidden').prop(function(_, val) {
                    return !val;
                });
                $(this).text($(this).text() === 'Chỉnh sửa' ? 'Hủy' : 'Chỉnh sửa');
            });
        </script>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="changeEmail" tabindex="-1" aria-labelledby="changeEmailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="mb-2">Nhập email mớI</label>
                        <input type="text" class="form-control" name="email" value="{{$user->email}}"
                            placeholder="abc@gmail.com">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
