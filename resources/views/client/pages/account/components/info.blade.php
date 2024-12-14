<div class="col-lg-12 mb-4">
    <div class="info-card p-4 shadow-sm rounded bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h7 class="fw-bold m-0 text-tgnt">
                <i class="bi bi-person-circle me-2"></i> Thông tin tài khoản
            </h7>
            <button class="btn btn-tgnt btn-sm" data-bs-toggle="modal" data-bs-target="#editAccount">
                <i class="bi bi-pencil-square"></i> Sửa
            </button>
        </div>
        <hr>
        <ul class="list-unstyled mb-1 info_account">
            <ul>
                <li><strong>Tên:</strong> <span class="account_name">{{ $user->name }}</span></li>
                <li><strong>Số điện thoại:</strong> <span class="account_phone">{{ $user->phone }}</span>
                </li>
                <li><strong>Email:</strong> <span class="account_email">{{ $user->email }}</span></li>
                <li><strong>Địa chỉ: </strong> {{ $user->ward->name ?? 'Chưa có ' }},
                    {{ $user->district->name ?? 'Chưa có' }},
                    {{ $user->province->name ?? 'Chưa có' }} </li>
            </ul>
        </ul>
        <div class="d-flex justify-content-between mt-3">
            <button data-bs-toggle="modal" data-bs-target="#changePass" class="btn btn-outline-tgnt btn-sm">Đổi mật
                khẩu</button>
            <a href="{{ route('client.auth.logout') }}" class="btn btn-tgnt btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-log-out">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <small>Đăng xuất</small>
            </a>
        </div>
    </div>
</div>
