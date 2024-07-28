<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رمز التحقق</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333333;
            margin: 0;
            padding: 0;
            direction: rtl;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            padding: 10px;
            color: white;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            margin: 20px 0;
            text-align: center;
        }
        .verification-code {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 4px;
            display: inline-block;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>رمز التحقق الخاص بك</h2>
        </div>
        <div class="content">
            <p>مرحباً {{ $details['name'] }}،</p>
            <p>نحن سعداء بانضمامك إلى منصة "الهدهد"، البديل المميز لليوتيوب في اليمن. نسعى لتقديم أفضل تجربة مشاهدة ومشاركة للفيديوهات.</p>
            <p>رمز التحقق الخاص بك هو:</p>
            <div class="verification-code">{{ $details['code'] }}</div>
            <p>يرجى إدخال هذا الرمز في صفحة التحقق لإتمام عملية التسجيل الخاصة بك.</p>
        </div>
        <div class="footer">
            <p>إذا لم تطلب رمز التحقق هذا، يرجى تجاهل هذه الرسالة.</p>
        </div>
    </div>
</body>
</html>
