class CusSweetAlert{

    success(message,time = 2000) {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: message,
            timer: time,
        });
    }
}



