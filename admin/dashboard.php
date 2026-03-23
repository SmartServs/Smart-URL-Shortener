<?php

session_start();

// التأكد من أن الأدمن مسجل دخوله
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// جلب الإحصائيات من قاعدة البيانات
include '../db.php';  // .. تشير إلى العودة إلى المجلد الجذري


// عدد الروابط
$links_query = "SELECT COUNT(*) AS total_links FROM urls";
$links_result = $conn->query($links_query);
$links_data = $links_result->fetch_assoc();
$total_links = $links_data['total_links'];

// عدد المستخدمين (لو فيه جدول للمستخدمين)
$users_query = "SELECT COUNT(*) AS total_users FROM users";
$users_result = $conn->query($users_query);
$users_data = $users_result->fetch_assoc();
$total_users = $users_data['total_users'];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الأدمن - SS2H</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        }

        .container {
            flex-grow: 1;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        .card h2 {
            margin: 10px 0;
        }

        .card a {
            text-decoration: none;
            color: #00e676;
            font-weight: bold;
        }

        .card a:hover {
            text-decoration: underline;
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
            margin: 0 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>🚀 لوحة تحكم الأدمن - SS2H</h1>
</header>

<div class="container">
    <!-- الإحصائيات -->
    <div class="card">
        <h2>الإحصائيات</h2>
        <p>عدد الروابط: <?php echo $total_links; ?>
    </div>

    <!-- إعدادات الموقع -->
    <div class="card">
        <h2>إعدادات الموقع</h2>
        <p>إعدادات الموقع مثل مدة التحويل، الاسم، إلخ.</p>
        <a href="settings.php">تعديل الإعدادات</a>
    </div>

    <!-- إدارة الروابط -->
    <div class="card">
        <h2>إدارة الروابط</h2>
        <p>عرض الروابط المختصرة وإدارتها</p>
        <a href="manage_links.php">عرض الروابط</a>
    </div>

    <!-- إدارة المستخدمين -->
    <div class="card">
        <h2>إدارة المستخدمين</h2>
        <p>إدارة مستخدمي الموقع (لو موجود)</p>
        <a href="manage_users.php">إدارة المستخدمين</a>
    </div>
</div>

<footer>
    <p>&copy; <?= date('Y') ?> SS2H.com - جميع الحقوق محفوظة</p>
</footer>

</body>
</html>
