<?php
session_start();
include 'db.php'; // الاتصال بقاعدة البيانات
$config = include('config.php'); // جلب إعدادات الموقع من config.php

function generateCode($length = 6) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function isValidUrl($url) {
    $parsed_url = parse_url($url);
    return isset($parsed_url['scheme']) && isset($parsed_url['host']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $original_url = $conn->real_escape_string($_POST['original_url']);

    if (strlen($original_url) > 350) {
        echo "<div class='result error'>❌ الرابط لا يمكن أن يتجاوز 350 حرفًا. يرجى إدخال رابط أقصر.</div>";
    } elseif (!isValidUrl($original_url)) {
        echo "<div class='result error'>❌ الرابط غير صالح. يرجى التأكد من إدخال رابط صحيح.</div>";
    } else {
        $code = generateCode();
        $check = $conn->query("SELECT * FROM urls WHERE short_code = '$code'");
        while ($check->num_rows > 0) {
            $code = generateCode();
            $check = $conn->query("SELECT * FROM urls WHERE short_code = '$code'");
        }

        $conn->query("INSERT INTO urls (original_url, short_code) VALUES ('$original_url', '$code')");
        $short_url = "https://ss2h.com/$code";

        $qr_image_path = 'qrcodes/' . $code . '.png';
        include('phpqrcode/qrlib.php');
        QRcode::png($short_url, $qr_image_path);

        header("Location: /index.php?short_url=" . urlencode($short_url) . "&qr_image=" . urlencode($qr_image_path));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($config['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($config['meta_description']) ?>" />
    <meta name="keywords" content="<?= htmlspecialchars($config['meta_keywords']) ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0; padding: 0;
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #f0f0f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 15px;
            text-align: center;
        }

        header {
            margin-bottom: 35px;
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        header p {
            font-size: 1.1rem;
            color: #dcdcdccc;
            max-width: 600px;
            margin: 0 auto;
        }

        .container {
            background: rgba(255 255 255 / 0.1);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px 30px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
            transition: box-shadow 0.3s ease-in-out;
        }
        .container:hover {
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
        }

        form input[type="url"] {
            width: 100%;
            padding: 18px 20px;
            border-radius: 12px;
            border: none;
            font-size: 1.15rem;
            outline: none;
            transition: box-shadow 0.3s;
        }

        form input[type="url"]:focus {
            box-shadow: 0 0 10px #ffa500aa;
            background-color: #fff8e1;
        }

        form button {
            margin-top: 20px;
            padding: 16px 0;
            width: 100%;
            font-size: 1.25rem;
            font-weight: 700;
            background: linear-gradient(45deg, #ff8a00, #e52e71);
            border: none;
            border-radius: 12px;
            color: #fff;
            cursor: pointer;
            transition: background 0.4s ease;
            box-shadow: 0 4px 15px rgba(229, 46, 113, 0.5);
        }
        form button:hover {
            background: linear-gradient(45deg, #e52e71, #ff8a00);
            box-shadow: 0 6px 20px rgba(255, 138, 0, 0.7);
        }

        .result {
            margin-top: 30px;
            background: rgba(0, 0, 0, 0.35);
            padding: 20px 25px;
            border-radius: 14px;
            word-break: break-word;
            font-size: 1.15rem;
            box-shadow: 0 4px 12px #000000bb;
        }
        .result.error {
            background: rgba(255, 60, 60, 0.85);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 4px 12px #ff4040bb;
        }

        .result a {
            color: #ffd54f;
            text-decoration: none;
            font-weight: 600;
        }
        .result a:hover {
            text-decoration: underline;
        }

        #copy-btn {
            margin-top: 15px;
            padding: 12px 25px;
            background-color: #ff9800;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            color: white;
            box-shadow: 0 4px 10px #ff9800bb;
            transition: background-color 0.3s ease;
        }
        #copy-btn:hover {
            background-color: #e68a00;
            box-shadow: 0 6px 15px #e68a00cc;
        }

        .qr-container {
            margin-top: 25px;
        }

        .qr-code img {
            width: 160px;
            height: 160px;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.6);
            transition: transform 0.3s ease;
        }
        .qr-code img:hover {
            transform: scale(1.05);
        }

        .social-share {
            margin-top: 30px;
        }
        .social-share a {
            margin: 0 12px;
            color: #fff;
            font-size: 28px;
            transition: color 0.3s ease;
        }
        .social-share a:hover {
            color: #ffd54f;
            transform: scale(1.15);
        }

        #new-short-url-btn {
            margin-top: 30px;
            padding: 14px 30px;
            font-size: 1.1rem;
            background-color: #ff5722;
            border: none;
            border-radius: 14px;
            font-weight: 700;
            cursor: pointer;
            color: #fff;
            box-shadow: 0 5px 18px #ff5722cc;
            transition: background-color 0.3s ease;
        }
        #new-short-url-btn:hover {
            background-color: #e64a19;
            box-shadow: 0 7px 22px #e64a19cc;
        }

        footer {
            margin-top: 40px;
            color: #dcdcdccc;
            font-size: 14px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            user-select: none;
        }

        footer a {
            color: #ffd54f;
            margin: 0 8px;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            header h1 {
                font-size: 2rem;
            }
            form input[type="url"], form button, #new-short-url-btn {
                font-size: 1rem;
            }
            .social-share a {
                font-size: 24px;
                margin: 0 8px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>🚀 <?= htmlspecialchars($config['site_name']) ?> - اختصر روابطك بسهولة</h1>
    <p><?= htmlspecialchars($config['meta_description']) ?></p>
</header>

<div class="container">
    <form method="post" autocomplete="off">
        <input type="url" name="original_url" placeholder="أدخل الرابط الطويل هنا" required>
        <button type="submit">اختصر الآن</button>
    </form>

    <?php
    if (isset($_GET['short_url'])):
        $short_url = htmlspecialchars($_GET['short_url']);
        $qr_image = isset($_GET['qr_image']) ? htmlspecialchars($_GET['qr_image']) : '';
    ?>
        <div class="result">
            ✅ رابطك المختصر: <br>
            <a href="<?= $short_url ?>" target="_blank" rel="noopener"><?= $short_url ?></a>
        </div>
        <button id="copy-btn" onclick="copyToClipboard()">نسخ الرابط</button>

        <?php if ($qr_image): ?>
            <div class="qr-container">
                <div class="qr-code">
                    <strong>QR Code:</strong><br>
                    <img src="<?= $qr_image ?>" alt="QR Code" loading="lazy" />
                </div>
            </div>
        <?php endif; ?>

        <div class="social-share" aria-label="مشاركة على وسائل التواصل الاجتماعي">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($short_url) ?>" target="_blank" title="مشاركة على فيسبوك" rel="noopener"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?url=<?= urlencode($short_url) ?>" target="_blank" title="مشاركة على تويتر" rel="noopener"><i class="fab fa-twitter"></i></a>
            <a href="https://wa.me/?text=<?= urlencode($short_url) ?>" target="_blank" title="مشاركة على واتساب" rel="noopener"><i class="fab fa-whatsapp"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($short_url) ?>" target="_blank" title="مشاركة على لينكدإن" rel="noopener"><i class="fab fa-linkedin"></i></a>
        </div>

        <button id="new-short-url-btn" onclick="window.location.href='/index.php'">اختصر رابط آخر</button>
    <?php endif; ?>
</div>

<footer>
    <p>
        <a href="/about.php">من نحن</a> |
        <a href="/privacy.php">سياسة الخصوصية</a> |
        <a href="/contact.php">اتصل بنا</a>
    </p>
    <p>&copy; <?= date('Y') ?> SS2H.com - جميع الحقوق محفوظة</p>
</footer>

<script>
function copyToClipboard() {
    const url = "<?= isset($short_url) ? $short_url : '' ?>";
    if (!url) return;
    navigator.clipboard.writeText(url).then(() => {
        alert("تم نسخ الرابط إلى الحافظة!");
    }).catch(() => {
        alert("حدث خطأ أثناء النسخ. حاول مجددًا.");
    });
}
</script>

</body>
</html>
