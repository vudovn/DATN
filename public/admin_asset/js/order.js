function updatePaymentStatus(orderId, paymentStatus) {
    $.order({
        url: '/orders/' + orderId + '/update-payment-status',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'), 
            payment_status: paymentStatus
        },
        success: function(response) {
            alert('Cập nhật trạng thái thanh toán thành công!');
        },
        error: function(xhr) {
            alert('Có lỗi xảy ra khi cập nhật trạng thái thanh toán.');
        }
    });
}
