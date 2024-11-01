<!DOCTYPE html>
<html>
<head>
    <title>Yêu cầu đặt lại mật khẩu</title>
</head>
<body>
    <h1>Yêu cầu đặt lại mật khẩu</h1>
    <p>Xin chào, {{ $user->name }}!</p>
    <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu từ tài khoản của bạn.</p>
    <p>Bấm vào <a href="{{ $resetUrl }}">đây</a> để đặt lại mật khẩu.</p>
    <p>Nếu bạn không thực hiện yêu cầu này, hãy bỏ qua email này.</p>
    <p>Cảm ơn,<br>{{ config('app.name') }}</p>
</body>
</html>
