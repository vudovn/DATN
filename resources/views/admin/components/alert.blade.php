{{-- return with('success','oke') --}}
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: '{{ session('success') }}',
            timer: 3000,
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Không thành công!',
            text: '{{ session('error') }}',
            timer: 3000,
        });
    </script>
@endif

@if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Cảnh báo!',
            text: '{{ session('warning') }}',
            timer: 3000,
        });
    </script>
@endif

{{-- @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Vui lòng kiểm tra lại thông tin điền vào!',
            timer: 3000,
        });
    </script>
@endif --}}

