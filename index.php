<?php
session_start();

if (isset($_SESSION['kullanici_id'])) {
    header("Location: dashboard.php");
} else {
    header("Location: auth/login.php");
}
exit;
?>