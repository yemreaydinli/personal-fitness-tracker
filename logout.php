<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = array();
session_destroy();

header("Location: /~st24360859015/auth/login.php");
exit;
?>