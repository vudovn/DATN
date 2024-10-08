
@if (session('success'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        })
    </script>
@endif

@if (session('error'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        })
    </script>
@endif

@if (session('warning'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'warning',
            title: "{{ session('warning') }}"
        })
    </script>
@endif

@if (session('info'))
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            icon: 'info',
            title: "{{ session('info') }}"
        })
    </script>
@endif


