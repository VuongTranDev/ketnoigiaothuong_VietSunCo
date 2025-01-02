<!DOCTYPE html>
<html>
<head>
    <title>Thông báo cuộc hẹn mới</title>
</head>
<body>
    <h1>Xin chào!</h1>
    <p>Bạn có một cuộc hẹn mới từ {{ $transaction->sender_id }}.</p>
    <p>Thông tin cuộc hẹn:</p>
    <ul>
        <li>Tiêu đề: {{ $transaction->title }}</li>
        <li>Nội dung: {{ $transaction->content }}</li>
        <li>Thời gian gặp: {{ $transaction->date_meet }}</li>
        <li>Địa chỉ: {{ $transaction->address }}</li>
    </ul>
    <p>Trân trọng!</p>
</body>
</html>
