<?php
session_start();
include '../db.php';  // .. تشير إلى العودة إلى المجلد الجذري

// التأكد من أن الأدمن مسجل دخوله
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// استرجاع الإعدادات من قاعدة البيانات
$query = "SELECT * FROM settings";
$result = $conn->query($query);

// إذا تم إرسال النموذج لتحديث الإعدادات
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $redirect_delay = isset($_POST['redirect_delay']) ? (int)$_POST['redirect_delay'] : 5; // قيمة افتراضية 5

    // تحديث قيمة الإعدادات في قاعدة البيانات
    $update_query = "UPDATE settings SET setting_value = '$redirect_delay' WHERE setting_key = 'redirect_delay'";

    if ($conn->query($update_query) === TRUE) {
        $message = "تم تحديث الإعدادات بنجاح!";
    } else {
        $message = "حدث خطأ أثناء تحديث الإعدادات: " . $conn->error;
    }
}

// استرجاع الإعدادات بعد التحديث
$query = "SELECT * FROM settings WHERE setting_key = 'redirect_delay'";
$result = $conn->query($query);
$setting_value = 5; // القيمة الافتراضية
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $setting_value = (int)$row['setting_value'];
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعدادات - SS2H</title>
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        body {
           font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        header {
            padding: 30px;
            text-align: center;
            background-color: #111;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
        }

        header h1 {
            margin: 0;
            font-size: 32px;
            color: #fff;
        }

        .container {
            flex-grow: 1;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: right;
        }

        .form-group label {
            font-size: 18px;
            margin-bottom: 10px;
            display: block;
        }

        .form-group input {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group input[type="submit"] {
            background-color: #00e676;
            color: white;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #00c853;
        }

        footer {
            background-color: #222;
            text-align: center;
            padding: 10px;
            color: #ccc;
            font-size: 14px;
        }

        footer a {
            color: #ffeb3b;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
        }

        .message {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: <?= isset($message) ? 'block' : 'none' ?>;
        }

        .error {
            background-color: #ff5252;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: <?= isset($message) ? 'block' : 'none' ?>;
        }
    </style>
</head>
<body>

<header>
    <h1>إعدادات الموقع</h1>
</header>

<div class="container">
    <div class="card">
        <h2>تعديل الإعدادات</h2>

        <!-- رسالة النجاح أو الخطأ -->
        <?php if (isset($message)): ?>
            <div class="<?= strpos($message, 'نجاح') !== false ? 'message' : 'error' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- نموذج تعديل الإعدادات -->
        <form method="POST">
            <div class="form-group">
                <label for="redirect_delay">تأخير التحويل (بالثواني):</label>
                <input type="number" id="redirect_delay" name="redirect_delay" value="<?= $setting_value ?>" min="1" required>
            </div>
            <div class="form-group">
                <input type="submit" value="حفظ التعديلات">
            </div>
        </form>
    </div>
</div>

<footer>
    <p>&copy; <?= date('Y') ?> SS2H.com - جميع الحقوق محفوظة</p>
</footer>

</body>
</html>
