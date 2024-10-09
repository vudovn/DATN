$(document).ready(function() {
    
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    function showSuccessToast(message) {
        Toast.fire({
            icon: 'success',
            title: message
        })
    }

    function showErrorToast(message) {
        Toast.fire({
            icon: 'error',
            title: message
        })
    }

    function showWarningToast(message) {
        Toast.fire({
            icon: 'warning',
            title: message
        })
    }

    function showInfoToast(message) {
        Toast.fire({
            icon: 'info',
            title: message
        })
    }

    // showSuccessToast('Đã load xong thư viện SweetAlert2');

});
