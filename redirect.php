<?php
include 'db.php';
$config = include('config.php'); // إضافة استرجاع الإعدادات من config.php

// نحصل على الكود من الرابط (مثلاً ss2h.com/abc123)
$code = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

// نجيب الرابط المختصر
if (!empty($code)) {
    $code = $conn->real_escape_string($code);
    $result = $conn->query("SELECT * FROM urls WHERE short_code = '$code'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $original_url = $row['original_url'];

        // تحديث عدد الزيارات في قاعدة البيانات
        $conn->query("UPDATE urls SET visits = visits + 1 WHERE short_code = '$code'");

        // نجيب وقت التأخير من جدول settings
        $delay_query = $conn->query("SELECT setting_value FROM settings WHERE setting_key = 'redirect_delay'");
        $delay = ($delay_query->num_rows > 0) ? (int)$delay_query->fetch_assoc()['setting_value'] : 5;
    } else {
        die("الرابط غير موجود أو منتهى الصلاحية.");
    }
} else {
    die("برجاء إدخال رابط صالح.");
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>جاري تحويلك...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Tahoma, sans-serif;
            text-align: center;
            padding-top: 100px;
            background-color: #f4f4f4;
            direction: rtl;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
            margin: 0 auto;
        }

        .countdown {
            font-size: 36px;
            color: #28a745;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .link-container {
            display: none;
            margin-top: 20px;
        }

        .link-container a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .link-container a:hover {
            text-decoration: underline;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #222;
            color: #ccc;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }

        footer a {
            color: #ffeb3b;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }

        .advertisement img {
            width: 100%;
            height: auto;
            margin: 10px 0;
        }

        .advertisement-banners {
            margin-top: 20px;
        }

        .ad-texts {
            margin-top: 20px;
        }

        .ad-text {
            font-size: 16px;
            margin: 10px 0;
        }

        .ad-text a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .ad-text a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        let countdown = <?php echo $delay; ?>;
        function startCountdown() {
            const timer = document.getElementById("timer");
            const redirectURL = "<?php echo $original_url; ?>";
            const linkContainer = document.getElementById("link-container");
            const interval = setInterval(() => {
                countdown--;
                timer.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(interval);
                    window.location.href = redirectURL;
                    // إظهار رابط "اضغط هنا"
                    linkContainer.style.display = "block";
                }
            }, 1000);
        }

        function redirectToLink() {
            window.location.href = "<?php echo $original_url; ?>";
        }

        window.onload = startCountdown;
    </script>
</head>
<body>

    <div class="container">
        <h2>⏳ سيتم تحويلك خلال <span id="timer"><?php echo $delay; ?></span> ثانية</h2>

        <!-- عرض كود الإعلان إذا كان موجوداً -->
        <div class="advertisement">
            <?= $config['advertisement_code'] ?> <!-- هنا يظهر كود الإعلان -->
        </div>

  <!-- عرض البنرات الإعلانية مع العنوان والرابط -->
<div class="advertisement-banners">
    <?php
    // عرض بنرات الإعلانات مع العنوان والرابط
    foreach ($config['banner_ads'] as $banner) {
        echo '<div>';
        echo '<a href="' . $banner['link'] . '" target="_blank">';

        // التحقق من وجود الصورة
        if (!empty($banner['image'])) {
            echo '<img src="' . $banner['image'] . '" alt="' . $banner['title'] . '">';
        } else {
            // إذا لم توجد صورة، عرض العنوان كنص فقط
            echo '<p>' . $banner['title'] . '</p>';
        }

        echo '</a>';
        echo '</div>';
    }
    ?>
</div>


       

        <div id="link-container" class="link-container">
            <p>إذا لم يتم تحويلك تلقائيًا، <a href="javascript:void(0);" onclick="redirectToLink()">اضغط هنا</a>.</p>
        </div>
    </div>

    <footer>
        <p>&copy; <?= date('Y') ?> SS2H.com - جميع الحقوق محفوظة</p>
    </footer>

</body>
</html>
