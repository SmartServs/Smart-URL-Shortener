<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>من نحن - SS2H</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
          font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* الشريط العلوي */
        .top-bar {
            background-color: #ffffff10;
            padding: 15px 10px;
            display: flex;
            justify-content: center;
            gap: 20px;
            box-shadow: 0 2px 5px #00000030;
        }

        .top-bar a {
            color: #fff;
            text-decoration: none;
            background-color: #000;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            transition: background 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .top-bar a:hover {
            background-color: #333;
        }

        header {
            padding: 30px 20px 10px;
            text-align: center;
        }

        header h1 {
            margin-bottom: 10px;
            font-size: 32px;
        }

        header p {
            font-size: 16px;
            color: #ddd;
        }

        .container {
            background-color: #ffffff10;
            padding: 40px 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px #00000050;
            text-align: center;
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
        }

        footer {
            margin-top: auto;
            background-color: #222;
            text-align: center;
            padding: 20px;
            color: #ccc;
            font-size: 14px;
        }

        footer a {
            color: #ffeb3b;
            margin: 0 10px;
        }

        footer a:hover {
            color: #fff;
        }
    </style>
    <!-- أيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

<!-- الشريط العلوي -->
<div class="top-bar">
    <a href="/index.php"><i class="fa fa-house"></i> الرئيسية</a>

</div>

<header>
    <h1>من نحن</h1>
    <p>نحن في SS2H نقدم لكم خدمة اختصار الروابط بشكل احترافي وسريع. نحن هنا لنساعدك في تقليل الروابط الطويلة وتحويلها إلى روابط مختصرة تسهل مشاركتها على الإنترنت.</p>
</header>

<div class="container">
    <h2>نحن فريق عمل متخصص في تقديم الحلول التقنية المتقدمة، ونسعى لتقديم أفضل الأدوات لعملائنا!</h2>
</div>

<footer>
    <p>
        <a href="/about.php">من نحن</a> |
        <a href="/privacy.php">سياسة الخصوصية</a> |
        <a href="/contact.php">اتصل بنا</a>
    </p>
    <p>&copy; <?= date('Y') ?> SS2H.com - جميع الحقوق محفوظة</p>
</footer>

</body>
</html>
