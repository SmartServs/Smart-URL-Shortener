<?php
session_start();
include '../db.php';  // .. تشير إلى العودة إلى المجلد الجذري


// التأكد من أن الأدمن مسجل دخوله
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// تأكد من أن هناك ID للرابط
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // حذف الرابط من قاعدة البيانات
    $query = "DELETE FROM urls WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_links.php"); // العودة إلى صفحة إدارة الروابط
        exit();
    } else {
        echo "حدث خطأ أثناء حذف الرابط.";
    }
} else {
    echo "لم يتم تحديد الرابط لحذفه.";
}
?>
