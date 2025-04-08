<?php
// เริ่ม session ก่อนเสมอ
session_start();

// เช็คว่ามี session อะไรอยู่ไหม
if (!empty($_SESSION)) {
    $_SESSION = []; // ลบ session ทั้งหมด
}



// ทำลาย session
session_destroy();

// redirect ไปหน้า login
header("Location: login.php");
exit;
