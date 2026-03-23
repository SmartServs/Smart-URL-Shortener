<?php
session_start();
include '../db.php';  // .. تشير إلى العودة إلى المجلد الجذري

// التأكد من أن الأدمن مسجل دخوله
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// تحديد عدد الروابط التي ستعرض في كل صفحة
$links_per_page = 20;

// الحصول على رقم الصفحة الحالية من الرابط (إما 1 أو أي رقم آخر)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $links_per_page;

// استرجاع إجمالي عدد الروابط في قاعدة البيانات
$query = "SELECT COUNT(*) AS total FROM urls";
$result = $conn->query($query);
$total_links = $result->fetch_assoc()['total'];

// استرجاع الروابط المختصرة مع التحديد (LIMIT)
$query = "SELECT * FROM urls LIMIT $offset, $links_per_page";
$result = $conn->query($query);

// حساب إجمالي عدد الصفحات
$total_pages = ceil($total_links / $links_per_page);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الروابط - SS2H</title>
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
            padding: 20px;
            text-align: center;
            background-color: #111;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
        }

        header h1 {
            margin: 0;
            font-size: 28px;
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

        .card table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto;
        }

        .card table, .card th, .card td {
            border: 1px solid #ddd;
        }

        .card th, .card td {
            padding: 12px;
            text-align: center;
            font-size: 16px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .card th {
            background-color: #333;
            color: #fff;
        }

        .card td {
            background-color: #222;
        }

        .card a {
            color: #00e676;
            font-weight: bold;
            text-decoration: none;
        }

        .card a:hover {
            text-decoration: underline;
        }

        .no-data {
            color: #ff5252;
            font-size: 18px;
            text-align: center;
            margin-top: 20px;
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

        /* استايل الجوال */
        @media (max-width: 768px) {
            header h1 {
                font-size: 24px;
            }

            .container {
                padding: 10px;
            }

            .card {
                padding: 15px;
            }

            .card h2 {
                font-size: 20px;
            }

            .card table th, .card table td {
                font-size: 14px;
                padding: 8px;
            }

            footer {
                font-size: 12px;
                padding: 5px;
            }
        }

        /* استايل الجوال الصغير */
        @media (max-width: 480px) {
            header h1 {
                font-size: 20px;
            }

            .card h2 {
                font-size: 18px;
            }

            .card table th, .card table td {
                font-size: 12px;
                padding: 6px;
            }

            .no-data {
                font-size: 16px;
            }

            footer {
                font-size: 10px;
                padding: 3px;
            }
        }

        /* تنسيق أزرار التنقل بين الصفحات */
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            color: #00e676;
            padding: 10px 20px;
            margin: 0 5px;
            text-decoration: none;
            font-weight: bold;
            background-color: #333;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #00e676;
            color: #333;
        }

        .pagination .disabled {
            color: #aaa;
            background-color: #222;
        }
    </style>
</head>
<body>

<header>
    <h1>إدارة الروابط المختصرة</h1>
</header>

<div class="container">
    <div class="card">
        <h2>الروابط المختصرة</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>الرابط الأصلي</th><th>الرابط المختصر</th><th>عدد الزيارات</th><th>الإجراء</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['original_url']) . "</td>";
                echo "<td><a href='" . htmlspecialchars($row['short_code']) . "' target='_blank'>" . htmlspecialchars($row['short_code']) . "</a></td>";
                echo "<td>" . htmlspecialchars($row['visits']) . "</td>";  // عرض عدد الزيارات
                echo "<td><a href='delete_link.php?id=" . $row['id'] . "'><i class='fa fa-trash'></i> حذف</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-data'>لا توجد روابط مختصرة في الوقت الحالي.</p>";
        }
        ?>
    </div>

    <!-- روابط التنقل بين الصفحات -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">&laquo; الصفحة السابقة</a>
        <?php else: ?>
            <span class="disabled">&laquo; الصفحة السابقة</span>
        <?php endif; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>">الصفحة التالية &raquo;</a>
        <?php else: ?>
            <span class="disabled">الصفحة التالية &raquo;</span>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>&copy; <?= date('Y') ?> SS2H.com - جميع الحقوق محفوظة</p>
</footer>

</body>
</html>
