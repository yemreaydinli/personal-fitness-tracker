<?php
$host = 'localhost';
$dbname = 'wtp_proje';
$username = 'root';
$password = ''; // XAMPP ve WAMP sunucularında varsayılan MySQL şifresi genellikle boştur.

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Hata raporlama modunu aktif et
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>