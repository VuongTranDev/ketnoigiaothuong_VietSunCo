<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-body p {
            margin-bottom: 15px;
        }
        .email-footer {
            background: #f4f4f9;
            color: #666666;
            text-align: center;
            padding: 15px;
            font-size: 12px;
        }
        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ $subject }}</h1>
        </div>
        <div class="email-body">
            <p>{!! nl2br(e($messageContent)) !!}</p>
        </div>
        <div class="email-footer">
            <p>Bạn nhận được email này vì đã gửi liên hệ đến chúng tôi.</p>
            <p>Vui lòng không trả lời email này. Nếu bạn có thắc mắc, hãy liên hệ với chúng tôi qua <a href="mailto:support@example.com">support@example.com</a>.</p>
        </div>
    </div>
</body>
</html>
